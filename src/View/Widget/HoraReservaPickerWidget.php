<?php
namespace App\View\Widget;

use Cake\I18n\FrozenTime;
use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

/**
 * Modela un widget reutilizable para mostrar un selector de horas de
 * reserva al usuario.
 *
 * @author Alejandro González García
 */
class HoraReservaPickerWidget implements WidgetInterface
{
    protected $_templates;

    /**
     * {@inheritDoc}
     */
    public function __construct($templates)
    {
        $this->_templates = $templates;
    }

    /**
     * {@inheritDoc}
     */
    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'name' => '',
        ];

        $fecha = $data['val'] ?: FrozenTime::now();
        $cadenaAhora = $fecha->i18nFormat('yyyy-MM-dd');
        $atributosDia = $this->_templates->formatAttributes(isset($data['dateAttributes']) ? $data['dateAttributes'] : []);
        $atributosHora = $this->_templates->formatAttributes(isset($data['timeAttributes']) ? $data['timeAttributes'] : []);

        return $this->_templates->format('horareservapicker', [
            'dia' => "<input type=\"date\" min=\"$cadenaAhora\"$atributosDia>",
            'hora' => "<input type=\"time\" min=\"09:00\" max=\"19:30\" step=\"600\"$atributosHora>"
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function secureFields(array $data)
    {
        return [$data['name']];
    }
}
