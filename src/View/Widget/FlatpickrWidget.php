<?php
namespace App\View\Widget;

use Cake\Routing\Router;
use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

/**
 * Un widget reutilizable para mostrar un selector de fecha
 * y hora Flatpickr al usuario. Los usuarios de este widget
 * son responsables de asegurar que el método estático
 * importarDependencias es llamado.
 *
 * @author Alejandro González García
 * @see https://flatpickr.js.org/
 */
class FlatpickrWidget implements WidgetInterface
{
    protected $_templates;

    /**
     * Las opciones base a usar para Flatpickr. Véase
     * https://flatpickr.js.org/options/.
     * El cliente enviará al servidor una timestamp Unix, que se puede
     * interpretar de manera inequívoca en la franja horaria local.
     */
    private $defaultFlatpickrOptions =
        'altInput: true, altFormat: "{{FORMATO_FECHA}}", ' .
        'ariaDateFormat: "{{FORMATO_FECHA}}", dateFormat: "U", ' .
        'prevArrow: "<i class=\"fas fa-angle-left\"></i>", ' .
        'nextArrow: "<i class=\"fas fa-angle-right\"></i>", ' .
        'locale: "{{IDIOMA}}"';

    /**
     * El Javascript que el agente de usuario empleará para cargar Flatpickr
     * y sus opciones.
     */
    private $flatpickrScript = '<script>flatpickr("#{{ID}}", { {{OPCS}} });</script>';

    /**
     * {@inheritDoc}
     */
    public function __construct($templates)
    {
        $this->_templates = $templates;

        $this->defaultFlatpickrOptions = str_replace(
            '{{FORMATO_FECHA}}',
            __('l, j F Y'),
            $this->defaultFlatpickrOptions
        );

        $this->defaultFlatpickrOptions = str_replace(
            '{{IDIOMA}}',
            __('es'),
            $this->defaultFlatpickrOptions
        );
    }

    /**
     * {@inheritDoc}
     */
    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'name' => '',
            'id' => '',
        ];

        $input = $this->_templates->format('flatpickrInput', [
            'attrs' => $this->_templates->formatAttributes($data, ['type', 'options', 'val', 'flatpickrOptions'])
        ]);

        $opcionesExtra = '';
        if (isset($data['flatpickrOptions']) && is_array($data['flatpickrOptions'])) {
            foreach ($data['flatpickrOptions'] as $clave => $valor) {
                if (is_string($clave) && (is_string($valor) || is_numeric($valor))) {
                    if (strpos($clave, 'on') === 0 || is_numeric($valor)) {
                        // No rodear callbacks o números con comillas
                        $opcionesExtra .= ",\n$clave: $valor";
                    } else {
                        $opcionesExtra .= ",\n$clave: \"$valor\"";
                    }
                }
            }
        }

        $script = str_replace(
            '{{OPCS}}',
            $this->defaultFlatpickrOptions . $opcionesExtra,
            $this->flatpickrScript
        );
        $script = str_replace('{{ID}}', $data['id'], $script);

        return $input . $script;
    }

    /**
     * {@inheritDoc}
     */
    public function secureFields(array $data)
    {
        return [$data['name'], $data['id']];
    }

    /**
     * Importa las dependencias de este widget a la vista en la que se usa.
     *
     * @param \Cake\View\View $vista La vista actual.
     * @return void
     */
    public static function importarDependencias($vista)
    {
        // Redireccionar al usuario a una página de error si no
        // activó Javascript
        $vista->assign('noscript', '<meta http-equiv="refresh" content="0;url=' . Router::url(['controller' => $vista->getRequest()->getParam('controller'), 'action' => 'errorJs']) . '">');

        // Estilos base y temas
        $vista->Html->css('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', ['block' => true]);
        $vista->Html->css('https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css', ['block' => true]);

        // Scripts y plugins
        $vista->Html->script('https://cdn.jsdelivr.net/npm/flatpickr', ['block' => true]);
        $vista->Html->script('https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js', ['block' => true]);
    }
}
