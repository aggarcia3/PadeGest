<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pareja Model
 *
 * @property \App\Model\Table\CategoriaNivelTable&\Cake\ORM\Association\BelongsTo $CategoriaNivel
 * @property \App\Model\Table\GrupoTable&\Cake\ORM\Association\BelongsTo $Grupo
 * @property \App\Model\Table\EnfrentamientoTable&\Cake\ORM\Association\BelongsToMany $Enfrentamiento
 *
 * @method \App\Model\Entity\Pareja get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pareja newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pareja[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pareja|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pareja saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pareja patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pareja[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pareja findOrCreate($search, callable $callback = null, $options = [])
 */
class ParejaTable extends Table
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

        $this->setTable('pareja');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CategoriaNivel', [
            'foreignKey' => 'categoria_nivel_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Grupo', [
            'foreignKey' => 'grupo_id',
        ]);
        $this->belongsToMany('Enfrentamiento', [
            'foreignKey' => 'pareja_id',
            'targetForeignKey' => 'enfrentamiento_id',
            'joinTable' => 'pareja_enfrentamiento',
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
            ->nonNegativeInteger('idCapitan')
            ->requirePresence('idCapitan', 'create')
            ->notEmptyString('idCapitan');

        $validator
            ->nonNegativeInteger('idCompanero')
            ->requirePresence('idCompanero', 'create')
            ->notEmptyString('idCompanero');

        $validator
            ->nonNegativeInteger('puntuacion')
            ->allowEmptyString('puntuacion', null, 'create');

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
        $rules->add($rules->existsIn(['categoria_nivel_id'], 'CategoriaNivel'));
        $rules->add($rules->existsIn(['grupo_id'], 'Grupo'));

        return $rules;
    }
}
