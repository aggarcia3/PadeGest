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
     * El componente encargado de autenticar al usuario, usado
     * en esta tabla para calcular restricciones.
     *
     * @var \Cake\Controller\Component\AuthComponent
     */
    private $auth;

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
            ->allowEmptyString('fecha', null, 'create');

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
        $rules->add(function ($noticia, $_) {
            return $this->auth !== null && $noticia->usuario_id == $this->auth->user('id');
        }, 'usuarioInvalido', [
            'errorField' => 'titulo',
            'message' => __('Las noticias solo pueden ser creadas por el usuario actual.'),
        ]);

        return $rules;
    }

    /**
     * Establece el componente encargado de autenticar al usuario, usado
     * en esta tabla para calcular restricciones.
     *
     * @param \Cake\Controller\Component\AuthComponent $auth El descrito componente.
     * @return void
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }
}
