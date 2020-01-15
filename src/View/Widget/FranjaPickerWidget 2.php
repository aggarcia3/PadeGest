<?php
namespace App\View\Widget;

use Cake\Routing\Router;
use Cake\View\Form\ContextInterface;
use Cake\View\Widget\WidgetInterface;

/**
 * Un widget reutilizable para mostrar un selector de franja
 * de horas de reserva al usuario. Los usuarios de este widget
 * son responsables de asegurar que el método estático
 * importarDependencias es llamado.
 *
 * @author Alejandro González García
 */
class FranjaPickerWidget implements WidgetInterface
{
    /**
     * {@inheritDoc}
     */
    public function render(array $data, ContextInterface $context)
    {
        ob_start();

        ?>
            <div class="franjapicker-mensaje-carga franjapicker-oculto d-flex flex-column justify-content-center align-items-center">
                <div class="spinner-border" role="status"></div>
                <p><?= __('Cargando horas de reserva...') ?></p>
            </div>
            <div class="franjapicker-mensaje-inicial d-flex justify-content-center align-items-center">
                <p><?= __('Escoge una fecha para ver las horas disponibles.') ?></p>
            </div>
        <?php

        return ob_get_clean();
    }

    /**
     * {@inheritDoc}
     */
    public function secureFields(array $data)
    {
        return [];
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
        $vista->Html->script('franjapicker.js', ['block' => true]);
        $vista->Html->script('sweetalert2.min.js', ['block' => true]);
    }
}
