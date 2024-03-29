<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pago Entity
 *
 * @property int $id
 * @property string $concepto
 * @property float $importe
 * @property \Cake\I18n\FrozenTime $fecha
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 */
class Pago extends Entity
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
        'concepto' => true,
        'importe' => true,
        'fecha' => true,
        'usuario_id' => true,
        'usuario' => true,
    ];
}
