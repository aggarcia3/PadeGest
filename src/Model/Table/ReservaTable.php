<?php
namespace App\Model\Table;

use Cake\Chronos\Chronos;
use Cake\Datasource\EntityInterface;
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
     * La hora de apertura del club, a partir de la cual se podrán crear
     * reservas, inclusive.
     *
     * @var \Cake\Chronos\Chronos
     */
    private static $horaApertura;

    /**
     * La hora de cierre del club, a partir de la cual no se podrán crear
     * más reservas, inclusive.
     *
     * @var \Cake\Chronos\Chronos
     */
    private static $horaCierre;

    /**
     * La duración de las reservas.
     *
     * @var DateInterval
     */
    private static $duracionReservas;

    /**
     * El número máximo de reservas que un deportista puede tener a
     * su nombre simultáneamente.
     *
     * @var int
     */
    private static $reservasMaximasDeportista = 5;

    /**
     * El componente encargado de autenticar al usuario, usado
     * en esta tabla para calcular restricciones.
     *
     * @var \Cake\Controller\Component\AuthComponent
     */
    private $auth;

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
            ->notEmpty('pista_id', __('No se puede crear una reserva sobre ninguna pista.'), true)
            ->nonNegativeInteger('pista_id', __('Esa pista no existe en el sistema.'))
            ->requirePresence('pista_id', 'create', __('No se puede crear una reserva sobre ninguna pista.'));

        $validator
            ->dateTime('fechaInicio', ['ymd'], __('La fecha de reserva sigue un formato incorrecto.'))
            ->requirePresence('fechaInicio', 'create', __('Es necesario especificar una fecha y hora para una reserva.'))
            ->notEmptyDateTime('fechaInicio', __('Es necesario especificar una fecha y hora para una reserva.'), 'create')
            ->add('fechaInicio', 'conAntelacion', [
                'rule' => function ($value, $context) {
                    if (!$context['newRecord'] || !($value instanceof DateTimeInterface)) {
                        return true;
                    } else {
                        // Ignorar horas, minutos y segundos, pero usar la franja horaria
                        // actual (FrozenDate usa GMT)
                        $fecha = FrozenTime::now()->setTime(0, 0);

                        return $fecha->add(self::getAntelacionCreacion()) <= $value;
                    }
                },
                'message' => __('Las reservas deben de crearse con antelación suficiente.')
            ])
            ->add('fechaInicio', 'franjaValida', [
                'rule' => function ($value, $context) {
                    if (!$context['newRecord'] || !($value instanceof Chronos)) {
                        return true;
                    } else {
                        // Establecer la fecha de la hora de apertura y cierre a la de la reserva
                        $horaApertura = self::getHoraApertura()->setDate($value->year, $value->month, $value->day);
                        $horaCierre = self::getHoraCierre()->setDate($value->year, $value->month, $value->day);

                        // Comprobar si está abierto el club a esas horas
                        $abiertoEnHora = $value >= $horaApertura && $value < $horaCierre;
                        // Si está abierto el club a esas horas, comprobar que la reserva empieza en una de las franjas
                        // prestablecidas
                        $franjaExistente = $abiertoEnHora && ($value->diffInMinutes($horaApertura) % self::getDuracionReservas()->i === 0);

                        return $franjaExistente;
                    }
                },
                'message' => __('La franja seleccionada para la reserva no es válida.')
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

        $rules->add(function ($reserva, $_) {
            $tablaPistas = TableRegistry::getTableLocator()->get('Pista');
            assert($tablaPistas instanceof PistaTable);

            return $tablaPistas->libreEn($reserva->fechaInicio) !== null;
        }, 'pistaDisponibleParaReserva', [
            'errorField' => 'fechaInicio',
            'message' => __('La pista está ocupada en esa fecha y hora.')
        ]);

        $rules->add(function ($reserva, $_) {
            if ($this->auth === null) {
                $usuario = TableRegistry::getTableLocator()->get('Usuario')
                    ->find()
                    ->where(['id' => $reserva->usuario_id])
                    ->first();
            } else {
                $usuario = $this->auth->user();
            }

            return $usuario === null || self::puedeDeportistaEfectuarReservas($usuario);
        }, 'reservasMaximasAlcanzadas', [
            'errorField' => 'fechaInicio',
            'message' => __('No puedes tener más de {0} reservas activas simultáneamente.', self::$reservasMaximasDeportista)
        ]);

        for ($i = 0, $events = [ 'add', 'addDelete' ]; $i < 2; ++$i) {
            $rules->{$events[$i]}(function ($reserva, $_) {
                return self::esModificable($reserva);
            }, 'esModificable', [
                'errorField' => 'fechaInicio',
                'message' => __('No se puede modificar una reserva a menos de {0} horas de su comienzo.', self::getIntervaloSoloLectura()->h)
            ]);
        }

        return $rules;
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
     * Devuelve la hora de apertura del club, a partir de la cual se podrán
     * crear reservas, inclusive.
     *
     * @return \Cake\Chronos\Chronos La descrita hora.
     */
    public static function getHoraApertura()
    {
        if (self::$horaApertura === null) {
            $toret = new FrozenTime('09:00');
            self::$horaApertura = $toret;
        } else {
            $toret = self::$horaApertura;
        }

        return $toret;
    }

    /**
     * Devuelve la hora de cierre del club, a partir de la cual no se podrán
     * crear más reservas, inclusive.
     *
     * @return \Cake\Chronos\Chronos La descrita hora.
     */
    public static function getHoraCierre()
    {
        if (self::$horaCierre === null) {
            $toret = new FrozenTime('21:00');
            self::$horaCierre = $toret;
        } else {
            $toret = self::$horaCierre;
        }

        return $toret;
    }

    /**
     * Computa las franjas horarias disponibles para reservar, teniendo en
     * cuenta la duración de las reservas y las horas de apertura y cierre del club.
     *
     * @return array Un array con las franjas de reservas posibles, donde a la
     * primera franja le corresponde el índice número 0.
     */
    public static function franjasReservas()
    {
        $minutosAbierto = self::getHoraCierre()->diffInMinutes(self::getHoraApertura(), true);
        $duracionReservas = self::getDuracionReservas()->i;
        $toret = [];
        $franja = self::getHoraApertura();

        for ($i = 0; $i < $minutosAbierto / $duracionReservas; ++$i) {
            $toret[] = $franja;
            $franja = $franja->add(self::getDuracionReservas());
        }

        return $toret;
    }

    /**
     * Comprueba si una reserva es modificable.
     *
     * @param \App\Model\Entity\Reserva $reserva La reserva a comprobar.
     * @return bool Verdadero si la reserva es modificable, falso en otro caso.
     */
    public static function esModificable($reserva)
    {
        return FrozenTime::now() <= $reserva->get('fechaInicio')->sub(self::getIntervaloSoloLectura());
    }

    /**
     * Devuelve la duración de las reservas.
     *
     * @return DateInterval La descrita duración.
     */
    public static function getDuracionReservas()
    {
        if (self::$duracionReservas === null) {
            $toret = new DateInterval('PT90M'); // 1 h 30 min
            self::$duracionReservas = $toret;
        } else {
            $toret = self::$duracionReservas;
        }

        return $toret;
    }

    /**
     * Comprueba si un deportista puede efectuar más reservas en el sistema
     * o no.
     *
     * @param \Cake\Datasource\EntityInterface|array $deportista El deportista a
     * comprobar.
     * @return bool Verdadero si el deportista puede efectuar más reservas,
     * falso en otro caso.
     */
    public static function puedeDeportistaEfectuarReservas($deportista)
    {
        $rol = is_array($deportista) ? $deportista['rol'] : $deportista->get('rol');
        $id = is_array($deportista) ? $deportista['id'] : $deportista->get('id');

        // Los administradores siempre pueden efectuar reservas
        $toret = $rol === 'administrador';

        if (!$toret) {
            $toret = TableRegistry::getTableLocator()->get('Reserva')
                ->find()
                ->select('id')
                ->where([
                    'usuario_id' => $id
                ])
                ->count() < self::$reservasMaximasDeportista;
        }

        return $toret;
    }

    /**
     * Establece el componente encargado de autenticar al usuario, usado
     * en esta tabla para calcular restricciones.
     *
     * @param \Cake\Controller\Component\AuthComponent $auth El descrito componente.
     * @return void
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }
}
