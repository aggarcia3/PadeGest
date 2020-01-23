<?php
namespace App\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Clase Model
 *
 * @property \App\Model\Table\ReservaTable&\Cake\ORM\Association\HasMany $Reserva
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsToMany $Usuario
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Entrenador
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

        $this->hasMany('Reserva', [
            'foreignKey' => 'clase_id',
        ]);
        $this->belongsToMany('Usuario', [
            'foreignKey' => 'clase_id',
            'targetForeignKey' => 'usuario_id',
            'joinTable' => 'clase_usuario',
        ]);
        $this->belongsTo('Entrenador', [
            'foreignKey' => 'entrenador_id',
            'targetTable' => 'Usuario',
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
            ->requirePresence('frecuencia', 'create')
            ->notEmptyString('frecuencia');

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
        $rules->add($rules->existsIn(['entrenador_id'], 'Usuario'));
        $rules->add(function ($clase, $_) {
            if ($clase->entrenador_id !== null) {
                return TableRegistry::getTableLocator()->get('Usuario')
                    ->get($clase->entrenador_id)->rol === 'entrenador';
            } else {
                return true;
            }
        }, 'entrenadorEsTal', [
            'errorField' => 'entrenador_id',
            'message' => __('El entrenador asociado a una clase debe de ser tal.'),
        ]);

        return $rules;
    }

    /**
     * Comprueba si una clase deportiva admite inscripciones actualmente.
     *
     * @param \App\Model\Entity\Clase $clase La clase a comprobar si admite inscripciones.
     * @return bool Verdadero si admite inscripciones, falso en otro caso.
     */
    public static function admiteInscripciones($clase)
    {
        $ahora = FrozenTime::now();
        $toret = $ahora > $clase->fechaInicioInscripcion && $ahora < $clase->fechaFinInscripcion;

        if ($toret) {
            $usuariosInscritos = TableRegistry::getTableLocator()->get('Clase')
                ->find()
                ->where(['id' => $clase->id])
                ->count();

            $toret = $usuariosInscritos < $clase->plazasMax;
        }

        return $toret;
    }
}
