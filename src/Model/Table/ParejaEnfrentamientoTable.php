<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParejaEnfrentamiento Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Pareja
 * @property &\Cake\ORM\Association\BelongsTo $Enfrentamiento
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
        $this->setDisplayField('enfrentamiento_id');
        $this->setPrimaryKey(['enfrentamiento_id', 'pareja_id']);

        $this->belongsTo('Pareja', [
            'foreignKey' => 'pareja_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Enfrentamiento', [
            'foreignKey' => 'enfrentamiento_id',
            'joinType' => 'INNER'
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
            ->notEmptyString('participacionConfirmada');

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
        $rules->add($rules->existsIn(['pareja_id'], 'Pareja'));
        $rules->add($rules->existsIn(['enfrentamiento_id'], 'Enfrentamiento'));

        return $rules;
    }
}
