<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuario Model
 *
 * @property \App\Model\Table\PartidoPromocionadoTable&\Cake\ORM\Association\BelongsToMany $PartidoPromocionado
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\BelongsToMany $Reserva
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuarioTable extends Table
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

        $this->setTable('usuario');
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
            ->scalar('username')
            ->maxLength('username', 32, __('El nombre de usuario es demasiado largo.'))
            ->requirePresence('username', 'create', __('El nombre de usuario no puede estar en blanco.'))
            ->notEmptyString('username', __('El nombre de usuario no puede estar en blanco.'));

        $validator
            ->scalar('password')
            ->lengthBetween('password', [32, 32], __('Ha ocurrido un error interno al almacenar la contraseña.'))
            ->requirePresence('password', 'create', __('La contraseña no puede estar en blanco.'))
            ->notEmptyString('password', __('La contraseña no puede estar en blanco.'), 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 50, __('El nombre es demasiado largo.'))
            ->requirePresence('nombre', 'create', __('El nombre no puede estar en blanco.'))
            ->notEmptyString('nombre', __('El nombre no puede estar en blanco.'));

        $validator
            ->scalar('apellidos')
            ->maxLength('apellidos', 50, __('Los apellidos son demasiado largos.'))
            ->requirePresence('apellidos', 'create', __('Los apellidos no pueden estar en blanco.'))
            ->notEmptyString('apellidos', __('Los apellidos no pueden estar en blanco.'));

        $validator
            ->requirePresence('genero', 'create', __('Es necesario especificar el género.'))
            ->notEmptyString('genero', __('Es necesario especificar el género.'))
            ->inList('genero', ['masculino', 'femenino'], __('El género especificado no es uno esperado por este sistema.'));

        $validator
            ->requirePresence('esSocio', 'create', __('Debe de saberse si un usuario es socio o no.'))
            ->notEmptyString('esSocio', __('Debe de saberse si un usuario es socio o no.'))
            ->inList('esSocio', [0, 1], __('Ha ocurrido un error interno al registrar el estado de asociación.'));

        $validator
            ->requirePresence('rol', 'create', __('Todo usuario debe de tener un rol asignado.'))
            ->notEmptyString('rol', __('Todo usuario debe de tener un rol asignado.'))
            ->inList('rol', ['deportista', 'administrador'], __('El rol especificado no es válido.'));

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
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }
}
