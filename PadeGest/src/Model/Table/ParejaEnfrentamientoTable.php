<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParejaEnfrentamiento Model
 *
 * @method \App\Model\Entity\ParejaEnfrentamiento get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParejaEnfrentamiento findOrCreate($search, callable $callback = null, $options = [])
 */
class ParejaEnfrentamientoTable extends Table
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

        $this->setTable('pareja_enfrentamiento');
        $this->setDisplayField('idEnfrentamiento');
        $this->setPrimaryKey(['idEnfrentamiento', 'idPareja']);
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
            ->nonNegativeInteger('idPareja')
            ->allowEmptyString('idPareja', null, 'create');

        $validator
            ->nonNegativeInteger('idEnfrentamiento')
            ->allowEmptyString('idEnfrentamiento', null, 'create');

        $validator
            ->notEmptyString('participacionConfirmada');

        return $validator;
    }
}
