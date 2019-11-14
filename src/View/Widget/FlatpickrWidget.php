<?php
namespace App\View\Widget;

use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

/**
 * Un widget reutilizable para mostrar un selector de fecha
 * y hora Flatpickr al usuario. Los usuarios de este widget
 * son responsables de asegurar que los scripts y estilos de
 * Flatpickr son cargados.
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
     * minTime y maxTime estarán en franja horaria peninsular española,
     * y se convertirán a la hora local correspondiente en el cliente.
     * El cliente enviará al servidor una timestamp Unix, que se puede
     * interpretar de manera inequívoca en la franja horaria local.
     */
    private $defaultFlatpickrOptions =
        'enableTime: true, altInput: true, altFormat: "{{FORMATO_FECHA}}", ' .
        'ariaDateFormat: "{{FORMATO_FECHA}}", dateFormat: "U", ' .
        'prevArrow: "<i class=\"fas fa-angle-left\"></i>", ' .
        'nextArrow: "<i class=\"fas fa-angle-right\"></i>", ' .
        'time_24hr: true, locale: "{{IDIOMA}}", ' .
        'minTime: {{HORA_APERTURA}}, maxTime: {{HORA_CIERRE}}, ' .
        'minuteIncrement: 1';

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
        // Horarios de apertura y cierre del club, convertidos a UTC
        $horaApertura = new Time('09:00', 'Europe/Madrid');
        $horaApertura->setTimezone('UTC');
        $horaCierre = new Time('20:00', 'Europe/Madrid');
        $horaCierre->setTimezone('UTC');

        $this->_templates = $templates;
        $this->defaultFlatpickrOptions = str_replace(
            '{{FORMATO_FECHA}}',
            __('l, j F Y, H:i'),
            $this->defaultFlatpickrOptions
        );
        $this->defaultFlatpickrOptions = str_replace(
            '{{IDIOMA}}',
            __('es'),
            $this->defaultFlatpickrOptions
        );

        /**
         * Expresión de Javascript para convertir una hora UTC con precisión de minutos
         * a su representación local, valiéndose un objeto Date.
         *
         * @var string
         */
        $horaLocal = 'new Date(new Date().setUTCHours({{HORA_UTC}}, {{MIN_UTC}}))';

        foreach (['Apertura', 'Cierre'] as $puntoHorario) {
            ${'hora' . $puntoHorario . 'Local'} = str_replace('{{HORA_UTC}}', ${'hora' . $puntoHorario}->hour, $horaLocal);
            ${'hora' . $puntoHorario . 'Local'} = str_replace('{{MIN_UTC}}', ${'hora' . $puntoHorario}->minute, ${'hora' . $puntoHorario . 'Local'});
        }

        foreach (['Apertura' => '{{HORA_APERTURA}}', 'Cierre' => '{{HORA_CIERRE}}'] as $puntoHorario => $parametroConfig) {
            $this->defaultFlatpickrOptions = str_replace(
                $parametroConfig,
                // Compleja expresión de Javascript para leer horas en UTC y transformarlas a
                // cadenas de horas locales, sin usar variables ni funcionalidades no estándar
                "((${'hora' . $puntoHorario . 'Local'}).getHours() < 10 ? \"0\" + (${'hora' . $puntoHorario . 'Local'}).getHours() : (${'hora' . $puntoHorario . 'Local'}).getHours()) + \":\" + ((${'hora' . $puntoHorario . 'Local'}).getMinutes() < 10 ? \"0\" + (${'hora' . $puntoHorario . 'Local'}).getMinutes() : (${'hora' . $puntoHorario . 'Local'}).getMinutes())",
                $this->defaultFlatpickrOptions
            );
        }
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
        $vista->Html->script('https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/minMaxTimePlugin.js', ['block' => true]);
    }
}
