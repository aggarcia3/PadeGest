<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $nombre
 * @property string $apellidos
 * @property string $genero
 * @property int $esSocio
 * @property string $rol
 *
 * @property \App\Model\Entity\PartidoPromocionado[] $partido_promocionado
 * @property \App\Model\Entity\Reserva[] $reserva
 */
class Usuario extends Entity
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
        'login' => true,
        'password' => true,
        'nombre' => true,
        'apellidos' => true,
        'genero' => true,
        'esSocio' => true,
        'rol' => true,
        'partido_promocionado' => true,
        'reserva' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
