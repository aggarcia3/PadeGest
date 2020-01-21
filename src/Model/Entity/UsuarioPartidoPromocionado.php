<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsuarioPartidoPromocionado Entity
 *
 * @property int $usuario_id
 * @property int $partido_promocionado_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\PartidoPromocionado $partido_promocionado
 */
class UsuarioPartidoPromocionado extends Entity
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
        'usuario_id' => true,
        'partido_promocionado_id' => true,
    ];
}
