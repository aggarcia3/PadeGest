<?php
namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use DateInterval;
use DateTimeInterface;

/**
 * Reserva Model
 *
 * @property \App\Model\Table\PistaTable&\Cake\ORM\Association\BelongsTo $Pista
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\EnfrentamientoTable&\Cake\ORM\Association\HasOne $Enfrentamiento
 * @property \App\Model\Table\PartidoPromocionadoTable&\Cake\ORM\Association\HasOne $PartidoPromocionado
 *
 * @method \App\Model\Entity\Reserva get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reserva newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reserva[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reserva|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reserva saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reserva patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reserva[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reserva findOrCreate($search, callable $callback = null, $options = [])
 */
class ReservaTable extends Table
{
    /**
     * El intervalo de tiempo previo al inicio de la reserva durante
     * el cual no será modificable.
     *
     * @var DateInterval
     */
    private static $intervaloSoloLectura = null;

    /**
     * El intervalo de tiempo de antelación mínima con el que una nueva
     * reserva debe de hacerse.
     *
     * @var DateInterval
     */
    private static $antelacionCreacion = null;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('reserva');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pista', [
            'foreignKey' => 'pista_id',
            'joinType' => 'INNER'
        ])->setProperty('pista');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id'
        ]);

        $this->hasOne('Enfrentamiento', [
            'foreignKey' => 'reserva_id'
        ]);

        $this->hasOne('PartidoPromocionado', [
            'foreignKey' => 'reserva_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id', __('El número de reserva no puede ser negativo.'))
            ->allowEmptyString('id', __('El número de reserva no puede estar en blanco.'), true);

        $validator
            ->nonNegativeInteger('pista_id', __('Esa pista no existe en el sistema.'))
            ->requirePresence('pista_id', 'create', __('No se puede crear una reserva sobre ninguna pista.'));

        $validator
            ->dateTime('fechaInicio', ['ymd'], __('La fecha de reserva sigue un formato incorrecto.'))
            ->requirePresence('fechaInicio', 'create', __('Es necesario especificar una fecha para una reserva.'))
            ->notEmptyDateTime('fechaInicio', __('La fecha de reserva no puede estar vacía.'), 'create')
            ->add('fechaInicio', 'conAntelacion', [
                'rule' => function ($value, $context) {
                    if (!$context['newRecord'] || !($value instanceof DateTimeInterface)) {
                        return true;
                    } else {
                        return FrozenTime::now()->add(self::getAntelacionCreacion()) <= $value;
                    }
                },
                'message' => __('Las reservas deben de crearse con la antelación suficiente.')
            ]);

        // Por ahora, la fecha de fin se genera automáticamente
        $validator
            ->allowEmptyDateTime('fechaFin', __('La fecha de fin debe de estar vacía.'), true);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['pista_id'], 'Pista'), 'validTrack', [
            'errorField' => 'pista_id',
            'message' => __('Esa pista no existe en el sistema.')
        ]);

        $rules->add($rules->existsIn(['usuario_id'], 'Usuario'), 'validUser', [
            'errorField' => 'usuario_id',
            'message' => __('Ese usuario no existe en el sistema.')
        ]);

        $rules->add([$this, 'pistaDisponibleParaReserva'], 'pistaDisponibleParaReserva', [
            'errorField' => 'fechaInicio',
            'message' => __('La pista está ocupada en esa fecha y hora.')
        ]);

        for ($i = 0, $events = [ 'add', 'addDelete' ]; $i < 2; ++$i) {
            $funcName = $events[$i];
            $rules->$funcName([$this, 'esModificable'], 'esModificable', [
                'errorField' => 'fechaInicio',
                'message' => __('No se puede modificar una reserva a menos de ' . self::getIntervaloSoloLectura()->h . ' horas de su comienzo.')
            ]);
        }

        return $rules;
    }

    /**
     * Comprueba si la pista asociada a una reserva está disponible en la fecha
     * indicada por la reserva.
     *
     * @param \Cake\Datasource\EntityInterface $reserva La reserva a comprobar si es válida.
     * @param array $options Opciones específicas a la regla de validación.
     * @return bool Verdadero si la reserva puede efectuarse, falso en otro caso.
     */
    public function pistaDisponibleParaReserva($reserva, $options = [])
    {
        $toret = false;

        $sentencia = ConnectionManager::get('default')
            ->prepare('SELECT `PADEGEST`.`reservaQueOcupaPista`(?, ?, ?) AS idReserva');

        $sentencia->bind(
            [$reserva->get('pista_id'), $reserva->get('fechaInicio'), $reserva->get('id')],
            ['integer', 'datetime', 'integer']
        );

        if ($sentencia->execute()) {
            $idReservaConflictiva = $sentencia->fetch('assoc')['idReserva'];
            $toret = $idReservaConflictiva == null;
        }

        return $toret;
    }

    /**
     * Comprueba si una reserva es modificable. Este método ejecuta una operación
     * modificadora sobre el atributo fechaInicio, por lo que se recomienda que sea
     * una instancia de una fecha inmutable.
     *
     * @param \Cake\Datasource\EntityInterface $reserva La reserva a comprobar si es válida.
     * @param array $options Opciones específicas a la regla de validación.
     * @return bool Verdadero si la reserva es modificable, falso en caso contrario.
     */
    public function esModificable($reserva, $options = [])
    {
        return FrozenTime::now() <= $reserva->get('fechaInicio')->sub(self::getIntervaloSoloLectura());
    }

    /**
     * Devuelve el intervalo del tiempo previo al inicio de la reserva
     * durante el cual ésta no es modificable.
     *
     * @return DateInterval El descrito intervalo.
     */
    public static function getIntervaloSoloLectura()
    {
        if (self::$intervaloSoloLectura === null) {
            $toret = new DateInterval('PT12H'); // 12 h
            self::$intervaloSoloLectura = $toret;
        } else {
            $toret = self::$intervaloSoloLectura;
        }

        return $toret;
    }

    /**
     * Devuelve el intervalo de tiempo de antelación mínima con el que una
     * nueva reserva debe de hacerse.
     *
     * @return DateInterval El descrito intervalo.
     */
    public static function getAntelacionCreacion()
    {
        if (self::$antelacionCreacion === null) {
            $toret = new DateInterval('P7D'); // 7 días
            self::$antelacionCreacion = $toret;
        } else {
            $toret = self::$antelacionCreacion;
        }

        return $toret;
    }

    /**
     * Obtiene la primera pista libre para una determinada fecha.
     *
     * @param DateTimeInterface $fecha La fecha a comprobar si tiene alguna pista libre.
     * @return array|\Cake\Datasource\EntityInterface|null La primera pista libre encontrada
     * para esa fecha, o nulo si no hay ninguna.
     */
    public static function pistaLibre($fecha)
    {
        /** @var \App\Model\Entity\Pista */
        $pistaLibre = null;

        if ($fecha instanceof DateTimeInterface) {
            $sentencia = ConnectionManager::get('default')
                ->prepare('SELECT `PADEGEST`.`pistaDisponibleEnFecha`(?) AS idPista');

            $sentencia->bind([$fecha], ['datetime']);

            if ($sentencia->execute()) {
                $idPista = $sentencia->fetch('assoc')['idPista'];

                if (is_numeric($idPista)) {
                    $pistaLibre = TableRegistry::getTableLocator()->get('Pista')
                        ->find()
                        ->where(['id' => $idPista])
                        ->first();
                }
            }
        }

        return $pistaLibre;
    }
}
