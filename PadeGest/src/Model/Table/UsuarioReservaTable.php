<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsuarioReserva Model
 *
 * @method \App\Model\Entity\UsuarioReserva get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsuarioReserva newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsuarioReserva[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioReserva|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuarioReserva saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuarioReserva patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioReserva[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioReserva findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuarioReservaTable extends Table
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

        $this->setTable('usuario_reserva');
        $this->setDisplayField('idUsuario');
        $this->setPrimaryKey(['idUsuario', 'idReserva']);
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
            ->nonNegativeInteger('idUsuario')
            ->allowEmptyString('idUsuario', null, 'create');

        $validator
            ->nonNegativeInteger('idReserva')
            ->allowEmptyString('idReserva', null, 'create');

        return $validator;
    }
}
