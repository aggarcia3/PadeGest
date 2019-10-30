<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reserva Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $fecha
 * @property int $idPista
 *
 * @property \App\Model\Entity\Usuario[] $usuario
 */
class Reserva extends Entity
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
        'fecha' => true,
        'idPista' => true,
        'usuario' => true
    ];
}
