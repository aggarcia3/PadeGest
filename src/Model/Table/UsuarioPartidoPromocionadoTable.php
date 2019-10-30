<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsuarioPartidoPromocionado Model
 *
 * @method \App\Model\Entity\UsuarioPartidoPromocionado get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuarioPartidoPromocionadoTable extends Table
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

        $this->setTable('usuario_partido_promocionado');
        $this->setDisplayField('idUsuario');
        $this->setPrimaryKey(['idUsuario', 'idPartidoPromocionado']);
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
            ->nonNegativeInteger('idPartidoPromocionado')
            ->allowEmptyString('idPartidoPromocionado', null, 'create');

        return $validator;
    }
}
