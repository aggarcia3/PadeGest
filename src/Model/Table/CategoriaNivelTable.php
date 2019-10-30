<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriaNivel Model
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

        $validator
            ->nonNegativeInteger('idCampeonato')
            ->requirePresence('idCampeonato', 'create')
            ->notEmptyString('idCampeonato');

        return $validator;
    }
}
