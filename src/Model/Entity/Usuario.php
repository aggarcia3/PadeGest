<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $nombre
 * @property string $apellidos
 * @property string $genero
 * @property int $esSocio
 * @property string $rol
 *
 * @property string $nombre_completo
 * @property string $estado_asociado
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
        'username' => true,
        'password' => true,
        'nombre' => true,
        'apellidos' => true,
        'genero' => true,
        'esSocio' => true,
        'rol' => true,
    ];

    /**
     * Atributos generados en tiempo de ejecución a partir
     * de otros.
     *
     * @var array
     */
    protected $_virtual = [
        'nombre_completo',
        'estado_asociado'
    ];

    /**
     * Obtiene el nombre completo del usuario, resultado
     * de concatenar su nombre con sus apellidos.
     *
     * @return string El nombre completo del usuario.
     */
    protected function _getNombreCompleto()
    {
        return $this->nombre . '  ' . $this->apellidos;
    }

    /**
     * Obtiene el estado de asociación del deportista al club,
     * computado a partir del valor almacenado en el atributo
     * esSocio. Este estado es el más amigable para mostrar
     * al usuario.
     *
     * @return string El descrito estado.
     */
    protected function _getEstadoAsociado()
    {
        return $this->esSocio == 0 ? __('Deportista') : __('Socio');
    }
}
