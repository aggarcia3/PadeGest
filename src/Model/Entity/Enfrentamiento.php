<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enfrentamiento Entity
 *
 * @property int $id
 * @property string $nombre
 * @property \Cake\I18n\FrozenTime $fecha
 * @property string $fase
 * @property int|null $reserva_id
 *
 * @property \App\Model\Entity\Pareja $pareja
 * @property \App\Model\Entity\Reserva $reserva
 * @property \App\Model\Entity\Resultado[] $resultado
 */
class Enfrentamiento extends Entity
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
        'nombre' => true,
        'fecha' => true,
        'fase' => true,
        'reserva_id' => true,
        'pareja' => true,
        'reserva' => true,
        'resultado' => true,
    ];
}
