<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClaseUsuario Entity
 *
 * @property int $clase_id
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Clase $clase
 * @property \App\Model\Entity\Usuario $usuario
 */
class ClaseUsuario extends Entity
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
        'clase_id' => true,
        'usuario_id' => true
    ];
}
