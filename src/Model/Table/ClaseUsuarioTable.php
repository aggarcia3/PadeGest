<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClaseUsuario Model
 *
 * @property \App\Model\Table\ClaseTable&\Cake\ORM\Association\BelongsTo $Clase
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 *
 * @method \App\Model\Entity\ClaseUsuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClaseUsuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClaseUsuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClaseUsuario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClaseUsuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClaseUsuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClaseUsuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClaseUsuario findOrCreate($search, callable $callback = null, $options = [])
 */
class ClaseUsuarioTable extends Table
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

        $this->setTable('clase_usuario');
        $this->setDisplayField('clase_id');
        $this->setPrimaryKey(['clase_id', 'usuario_id']);

        $this->belongsTo('Clase', [
            'foreignKey' => 'clase_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['clase_id'], 'Clase'));
        $rules->add($rules->existsIn(['usuario_id'], 'Usuario'));

        return $rules;
    }
}
