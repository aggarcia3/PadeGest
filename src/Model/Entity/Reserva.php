<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reserva Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $fechaInicio
 * @property \Cake\I18n\FrozenTime $fechaFin
 * @property int $pista_id
 * @property int|null $usuario_id
 *
 * @property \App\Model\Entity\Pista $pista
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Enfrentamiento|null $enfrentamiento
 * @property \App\Model\Entity\PartidoPromocionado|null $partido_promocionado
 * @property \App\Model\Entity\Clase|null $clase
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
        'fechaInicio' => true,
        'pista_id' => true,
        'usuario_id' => true,
        'pista' => true,
        'usuario' => true,
        'enfrentamiento' => true,
        'partido_promocionado' => true,
        'clase' => true
    ];
}
