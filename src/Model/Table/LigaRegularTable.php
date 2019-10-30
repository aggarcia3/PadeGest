<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LigaRegular Model
 *
 * @method \App\Model\Entity\LigaRegular get($primaryKey, $options = [])
 * @method \App\Model\Entity\LigaRegular newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LigaRegular[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LigaRegular|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LigaRegular saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LigaRegular patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LigaRegular[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LigaRegular findOrCreate($search, callable $callback = null, $options = [])
 */
class LigaRegularTable extends Table
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

        $this->setTable('liga_regular');
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

        return $validator;
    }
}
