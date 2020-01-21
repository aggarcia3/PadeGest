<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Noticia Model
 *
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 *
 * @method \App\Model\Entity\Noticium get($primaryKey, $options = [])
 * @method \App\Model\Entity\Noticium newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Noticium[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Noticium|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Noticium saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Noticium patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Noticium[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Noticium findOrCreate($search, callable $callback = null, $options = [])
 */
class NoticiaTable extends Table
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

        $this->setTable('noticia');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
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
            ->scalar('titulo')
            ->maxLength('titulo', 128)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo')
            ->add('titulo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('cuerpo')
            ->requirePresence('cuerpo', 'create')
            ->notEmptyString('cuerpo');

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
        $rules->add($rules->isUnique(['titulo']));
        $rules->add($rules->existsIn(['usuario_id'], 'Usuario'));

        return $rules;
    }
}
