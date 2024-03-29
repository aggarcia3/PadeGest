<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pista Entity
 *
 * @property int $id
 * @property string $tipoSuelo
 * @property string $tipoCerramiento
 * @property string $localizacion
 * @property int $focos
 */
class Pista extends Entity
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
        'tipoSuelo' => true,
        'tipoCerramiento' => true,
        'localizacion' => true,
        'focos' => true,
    ];
}
