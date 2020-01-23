<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clase Model
 *
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\HasOne $Reserva
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsToMany $Usuario
 *
 * @method \App\Model\Entity\Clase get($primaryKey, $options = [])
 * @method \App\Model\Entity\Clase newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Clase[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Clase|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clase saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Clase patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Clase[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Clase findOrCreate($search, callable $callback = null, $options = [])
 */
class ClaseTable extends Table
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

        $this->setTable('clase');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');

        $this->hasOne('Reserva', [
            'foreignKey' => 'clase_id',
        ]);
        $this->belongsToMany('Usuario', [
            'foreignKey' => 'clase_id',
            'targetForeignKey' => 'usuario_id',
            'joinTable' => 'clase_usuario',
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
            ->requirePresence('plazasMin', 'create')
            ->notEmptyString('plazasMin');

        $validator
            ->requirePresence('plazasMax', 'create')
            ->notEmptyString('plazasMax');

        $validator
            ->time('frecuencia')
            ->notEmptyTime('frecuencia');

        $validator
            ->date('fechaInicioInscripcion')
            ->requirePresence('fechaInicioInscripcion', 'create')
            ->notEmptyDate('fechaInicioInscripcion');

        $validator
            ->date('fechaFinInscripcion')
            ->requirePresence('fechaFinInscripcion', 'create')
            ->notEmptyDate('fechaFinInscripcion');

        $validator
            ->requirePresence('semanasDuracion', 'create')
            ->notEmptyString('semanasDuracion');

        $validator
            ->time('horaInicio')
            ->requirePresence('horaInicio', 'create')
            ->notEmptyTime('horaInicio');

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

        return $rules;
    }
}
