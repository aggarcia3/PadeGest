<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriaNivel Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Campeonato
 * @property &\Cake\ORM\Association\HasMany $Grupo
 * @property &\Cake\ORM\Association\HasMany $Pareja
 *
 * @method \App\Model\Entity\CategoriaNivel get($primaryKey, $options = [])
 * @method \App\Model\Entity\CategoriaNivel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CategoriaNivel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoriaNivel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriaNivel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriaNivel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriaNivel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriaNivel findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriaNivelTable extends Table
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

        $this->setTable('categoria_nivel');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Campeonato', [
            'foreignKey' => 'campeonato_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Grupo', [
            'foreignKey' => 'categoria_nivel_id'
        ]);
        $this->hasMany('Pareja', [
            'foreignKey' => 'categoria_nivel_id'
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('categoria')
            ->requirePresence('categoria', 'create')
            ->notEmptyString('categoria');

        $validator
            ->scalar('nivel')
            ->requirePresence('nivel', 'create')
            ->notEmptyString('nivel');

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
        $rules->add($rules->existsIn(['campeonato_id'], 'Campeonato'));

        return $rules;
    }
}
