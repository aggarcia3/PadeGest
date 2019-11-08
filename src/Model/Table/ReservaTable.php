<?php
namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateInterval;
use DateTimeImmutable;

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
            ->dateTime('fecha', ['ymd'], __('La fecha de reserva sigue un formato incorrecto.'))
            ->requirePresence('fecha', 'create', __('Es necesario especificar una fecha para una reserva.'))
            ->notEmptyDateTime('fecha', __('La fecha de reserva no puede estar vacía.'))
            ->lessThanOrEqual('fecha', FrozenTime::now()->i18nFormat('Y-m-d'));

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
            'errorField' => 'fecha',
            'message' => __('La pista está ocupada en esa fecha y hora.')
        ]);

        for ($i = 0, $events = [ 'addUpdate', 'addDelete' ]; $i < 2; ++$i) {
            $funcName = $events[$i];
            $rules->$funcName([$this, 'esModificable'], 'esModificable', [
                'errorField' => 'fecha',
                'message' => __('No se puede modificar una reserva a menos de ' . self::getIntervaloSoloLectura()->h . ' horas de su comienzo.')
            ]);
        }

        return $rules;
    }

    /**
     * Comprueba si una pista está disponible para ser reservada.
     *
     * @param \Cake\Datasource\EntityInterface $reserva La reserva a comprobar si es válida.
     * @param array $options Opciones específicas a la regla de validación.
     * @return bool Verdadero si está disponible la pista para efectuar esta reserva, falso en otro caso.
     */
    public function pistaDisponibleParaReserva($reserva, $options = [])
    {
        $toret = false;

        $sentencia = ConnectionManager::get('default')
            ->prepare('SELECT `PADEGEST`.`reservaQueOcupaPista`(?, ?, ?) AS idReserva');

        $sentencia->bind(
            [$reserva->get('pista_id'), $reserva->get('fecha'), $reserva->get('id')],
            ['integer', 'datetime', 'integer']
        );

        if ($sentencia->execute()) {
            $idReservaConflictiva = $sentencia->fetch('assoc')['idReserva'];
            $toret = $idReservaConflictiva === null || $idReservaConflictiva !== $reserva->get('id');
        }

        return $toret;
    }

    /**
     * Comprueba si una reserva es modificable.
     *
     * @param \Cake\Datasource\EntityInterface $reserva La reserva a comprobar si es válida.
     * @param array $options Opciones específicas a la regla de validación.
     * @return bool Verdadero si la reserva es modificable, falso en caso contrario.
     */
    public function esModificable($reserva, $options = [])
    {
        return new DateTimeImmutable() <= $reserva->get('fecha')->sub(self::getIntervaloSoloLectura());
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
            $toret = new DateInterval('PT8H'); // 8 h
            self::$intervaloSoloLectura = $toret;
        } else {
            $toret = self::$intervaloSoloLectura;
        }

        return $toret;
    }
}
