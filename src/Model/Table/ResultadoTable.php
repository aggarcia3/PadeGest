<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Resultado Model
 * @property \App\Model\Table\ResultadoTable&\Cake\ORM\Association\HasOne $Resultado
 * @method \App\Model\Entity\Resultado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Resultado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Resultado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Resultado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resultado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resultado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Resultado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Resultado findOrCreate($search, callable $callback = null, $options = [])
 */
class ResultadoTable extends Table
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

        $this->setTable('resultado');
        $this->setDisplayField('idEnfrentamiento');
        $this->setPrimaryKey('idEnfrentamiento');
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
            ->nonNegativeInteger('enfrentamiento_id')
            ->allowEmptyString('enfrentamiento_id', null, 'create');

        $validator
            ->requirePresence('set1pareja1', 'create')
            ->notEmptyString('set1pareja1');

        $validator
            ->requirePresence('set1pareja2', 'create')
            ->notEmptyString('set1pareja2');

        $validator
            ->requirePresence('set2pareja1', 'create')
            ->notEmptyString('set2pareja1');

        $validator
            ->requirePresence('set2pareja2', 'create')
            ->notEmptyString('set2pareja2');

        $validator
            ->allowEmptyString('set3pareja1');

        $validator
            ->allowEmptyString('set3pareja2');

        return $validator;
    }
}
