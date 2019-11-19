<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Resultado Entity
 *
 * @property int $idEnfrentamiento
 * @property int $set1pareja1
 * @property int $set1pareja2
 * @property int $set2pareja1
 * @property int $set2pareja2
 * @property int|null $set3pareja1
 * @property int|null $set3pareja2
 */
class Resultado extends Entity
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
        'set1pareja1' => true,
        'set1pareja2' => true,
        'set2pareja1' => true,
        'set2pareja2' => true,
        'set3pareja1' => true,
        'set3pareja2' => true
    ];
}
