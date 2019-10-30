<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pista Model
 *
 * @method \App\Model\Entity\Pistum get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pistum newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pistum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pistum|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pistum saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pistum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pistum[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pistum findOrCreate($search, callable $callback = null, $options = [])
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
            ->scalar('tipoSuelo')
            ->requirePresence('tipoSuelo', 'create')
            ->notEmptyString('tipoSuelo');

        $validator
            ->scalar('tipoCerramiento')
            ->requirePresence('tipoCerramiento', 'create')
            ->notEmptyString('tipoCerramiento');

        $validator
            ->scalar('localizacion')
            ->requirePresence('localizacion', 'create')
            ->notEmptyString('localizacion');

        $validator
            ->requirePresence('focos', 'create')
            ->notEmptyString('focos');

        return $validator;
    }
}
