<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriaNivel Entity
 *
 * @property int $id
 * @property string $categoria
 * @property string $nivel
 * @property int $idCampeonato
 */
class CategoriaNivel extends Entity
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
        'categoria' => true,
        'nivel' => true,
        'idCampeonato' => true
    ];
}
