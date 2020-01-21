<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PartidoPromocionado Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reserva
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsToMany $Usuario
 *
 * @method \App\Model\Entity\PartidoPromocionado get($primaryKey, $options = [])
 * @method \App\Model\Entity\PartidoPromocionado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PartidoPromocionado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PartidoPromocionado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PartidoPromocionado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PartidoPromocionado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PartidoPromocionado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PartidoPromocionado findOrCreate($search, callable $callback = null, $options = [])
 */
class PartidoPromocionadoTable extends Table
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

        $this->setTable('partido_promocionado');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reserva', [
            'foreignKey' => 'reserva_id',
        ]);
        $this->belongsToMany('Usuario', [
            'foreignKey' => 'partido_promocionado_id',
            'targetForeignKey' => 'usuario_id',
            'joinTable' => 'usuario_partido_promocionado',
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
