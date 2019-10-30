<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pareja Entity
 *
 * @property int $id
 * @property int $idCapitan
 * @property int $idCompanero
 * @property int $idCategoriaNivel
 * @property int|null $idGrupo
 *
 * @property \App\Model\Entity\Enfrentamiento[] $enfrentamiento
 */
class Pareja extends Entity
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
        'idCapitan' => true,
        'idCompanero' => true,
        'idCategoriaNivel' => true,
        'idGrupo' => true,
        'enfrentamiento' => true
    ];
}
