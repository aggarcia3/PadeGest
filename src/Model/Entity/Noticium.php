<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Noticium Entity
 *
 * @property int $id
 * @property string $titulo
 * @property string $cuerpo
 * @property \Cake\I18n\FrozenTime $fecha
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 */
class Noticium extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'titulo' => true,
        'cuerpo' => true,
        'fecha' => true,
        'usuario_id' => true,
        'usuario' => true,
    ];
}
