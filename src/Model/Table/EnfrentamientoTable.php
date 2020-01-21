<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enfrentamiento Model
 *
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\BelongsTo $Reserva
 * @property \App\Model\Table\ResultadoTable&\Cake\ORM\Association\HasOne $Resultado
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

        $this->belongsTo('Reserva', [
            'foreignKey' => 'reserva_id',
        ]);
        $this->hasOne('Resultado', [
            'foreignKey' => 'enfrentamiento_id',
        ]);
        $this->belongsToMany('Pareja', [
            'foreignKey' => 'enfrentamiento_id',
            'targetForeignKey' => 'pareja_id',
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
            ->scalar('nombre')
            ->maxLength('nombre', 45)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre')
            ->add('nombre', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDateTime('fecha');

        $validator
            ->scalar('fase')
            ->requirePresence('fase', 'create')
            ->notEmptyString('fase');

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
        $rules->add($rules->isUnique(['nombre']));
        $rules->add($rules->existsIn(['reserva_id'], 'Reserva'));

        return $rules;
    }
}
