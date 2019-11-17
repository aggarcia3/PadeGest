<?php
namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\InternalErrorException;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use DateTimeInterface;
use Exception;

/**
 * Pista Model
 *
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\HasMany $Reserva
 *
 * @method \App\Model\Entity\Pista get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pista newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pista[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pista|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pista saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pista patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pista[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pista findOrCreate($search, callable $callback = null, $options = [])
 */
class PistaTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pista');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('reserva')->setForeignKey('pista_id');
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, true);

        $validator
            ->inList('tipoSuelo', ['césped', 'moqueta', 'hormigón', 'cemento'], __('Una pista solo puede tener un suelo de césped, de moqueta, de hormigón o de cemento.'))
            ->requirePresence('tipoSuelo', 'create');

        $validator
            ->inList('tipoCerramiento', ['valla', 'pared', 'cristal'], __('Una pista solo puede ser tener como tipo de cerramiento una valla, una pared o cristales.'))
            ->requirePresence('tipoCerramiento', 'create');

        $validator
            ->inList('localizacion', ['exterior', 'interior'], __('Una pista solo puede ser exterior o interior.'))
            ->requirePresence('localizacion', 'create');

        $validator
            ->nonNegativeInteger('focos')
            ->lessThanOrEqual('focos', 100, __('Una pista puede tener hasta un máximo de 100 focos.'))
            ->requirePresence('focos', 'create');

        return $validator;
    }

    /**
     * Obtiene la primera pista libre para una determinada fecha.
     *
     * @param DateTimeInterface $fecha La fecha a comprobar si tiene alguna pista libre.
     * @return array|\Cake\Datasource\EntityInterface|null La primera pista libre encontrada
     * para esa fecha, o nulo si no hay ninguna.
     */
    public function libreEn($fecha)
    {
        /** @var \App\Model\Entity\Pista */
        $pistaLibre = null;

        try {
            if ($fecha instanceof DateTimeInterface) {
                $sentencia = ConnectionManager::get(self::defaultConnectionName())
                    ->prepare('SELECT `PADEGEST`.`pistaDisponibleEnFecha`(?) AS idPista');

                $sentencia->bind([$fecha], ['datetime']);

                if ($sentencia->execute()) {
                    $idPista = $sentencia->fetch('assoc')['idPista'];

                    if (is_numeric($idPista)) {
                        $pistaLibre = $this
                            ->find()
                            ->where(['id' => $idPista])
                            ->first();
                    }
                }
            }
        } catch (Exception $_) {
            throw new InternalErrorException();
        }

        return $pistaLibre;
    }
}
