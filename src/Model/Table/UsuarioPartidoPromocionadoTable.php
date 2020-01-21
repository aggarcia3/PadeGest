<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsuarioPartidoPromocionado Model
 *
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\PartidoPromocionadoTable&\Cake\ORM\Association\BelongsTo $PartidoPromocionado
 *
 * @method \App\Model\Entity\UsuarioPartidoPromocionado get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsuarioPartidoPromocionado findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuarioPartidoPromocionadoTable extends Table
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

        $this->setTable('usuario_partido_promocionado');
        $this->setDisplayField('usuario_id');
        $this->setPrimaryKey(['usuario_id', 'partido_promocionado_id']);

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PartidoPromocionado', [
            'foreignKey' => 'partido_promocionado_id',
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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuario'));
        $rules->add($rules->existsIn(['partido_promocionado_id'], 'PartidoPromocionado'));

        return $rules;
    }
}
