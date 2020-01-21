<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Campeonato Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $bases
 * @property \Cake\I18n\FrozenTime $fechaInicioInscripciones
 * @property \Cake\I18n\FrozenTime $fechaFinInscripciones
 */
class Campeonato extends Entity
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
        'bases' => true,
        'fechaInicioInscripciones' => true,
        'fechaFinInscripciones' => true,
    ];
}
