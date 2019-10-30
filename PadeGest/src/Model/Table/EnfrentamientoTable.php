<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enfrentamiento Model
 *
 * @property \App\Model\Table\ParejaTable&\Cake\ORM\Association\BelongsToMany $Pareja
 *
 * @method \App\Model\Entity\Enfrentamiento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Enfrentamiento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Enfrentamiento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Enfrentamiento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enfrentamiento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enfrentamiento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Enfrentamiento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Enfrentamiento findOrCreate($search, callable $callback = null, $options = [])
 */
class EnfrentamientoTable extends Table
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

        $this->setTable('enfrentamiento');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Pareja', [
            'foreignKey' => 'enfrentamiento_id',
            'targetForeignKey' => 'pareja_id',
            'joinTable' => 'pareja_enfrentamiento'
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
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDateTime('fecha');

        $validator
            ->nonNegativeInteger('idReserva')
            ->allowEmptyString('idReserva');

        return $validator;
    }
}
