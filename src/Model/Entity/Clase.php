<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clase Entity
 *
 * @property int $id
 * @property string $nombre
 * @property int $plazasMin
 * @property int $plazasMax
 * @property \Cake\I18n\FrozenTime $frecuencia
 * @property \Cake\I18n\FrozenDate $fechaInicioInscripcion
 * @property \Cake\I18n\FrozenDate $fechaFinInscripcion
 * @property int $semanasDuracion
 * @property \Cake\I18n\FrozenTime $horaInicio
 *
 * @property \App\Model\Entity\Reserva[] $reserva
 * @property \App\Model\Entity\Usuario[] $usuario
 */
class Clase extends Entity
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
        'plazasMin' => true,
        'plazasMax' => true,
        'frecuencia' => true,
        'fechaInicioInscripcion' => true,
        'fechaFinInscripcion' => true,
        'semanasDuracion' => true,
        'horaInicio' => true,
        'reserva' => true,
        'usuario' => true
    ];
}
