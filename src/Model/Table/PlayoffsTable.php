<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Playoffs Model
 *
 * @method \App\Model\Entity\Playoff get($primaryKey, $options = [])
 * @method \App\Model\Entity\Playoff newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Playoff[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Playoff|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playoff saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playoff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Playoff[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Playoff findOrCreate($search, callable $callback = null, $options = [])
 */
class PlayoffsTable extends Table
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

        $this->setTable('playoffs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->nonNegativeInteger('idLigaRegular')
            ->requirePresence('idLigaRegular', 'create')
            ->notEmptyString('idLigaRegular')
            ->add('idLigaRegular', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['idLigaRegular']));

        return $rules;
    }
}
