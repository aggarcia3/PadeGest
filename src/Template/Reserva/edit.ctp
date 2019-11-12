<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */

use App\Model\Table\ReservaTable;
use App\View\Widget\FlatpickrWidget;

// Page title
$this->assign('title', __('Gestión de {0}', __('reservas')));

// Importar dependencias de Flatpickr
FlatpickrWidget::importarDependencias($this);

// Sweetalert
$this->Html->script('https://unpkg.com/sweetalert/dist/sweetalert.min.js', ['block' => true]);

$esAdministrador = $Auth->user('rol') === 'administrador';

$timestampLimiteModificable = $hoy->add(ReservaTable::getIntervaloSoloLectura())->getTimestamp() * 1000; // Conversión a ms
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?=
            $this->Form->postLink(
                '<i class="fas fa-calendar-minus delete-action-fa-icon"></i> ' . __($esAdministrador ? 'Eliminar {0}' : 'Cancelar {0}', __('reserva')),
                ['action' => 'delete', $reserva->id],
                ['escapeTitle' => false, 'confirm' =>
                    __('¿Estás seguro de que quieres ' . ($esAdministrador ? 'eliminar' : 'cancelar') . ' {0}? Esto borrará toda su información asociada.', [__('la reserva número {0}', $reserva->id)])
                ]
            )
        ?></li>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver ' . ($esAdministrador ? '' : 'mis ') . '{0}', __('reservas')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-calendar-plus add-action-fa-icon"></i> ' . __($esAdministrador ? 'Crear {0}' : 'Reservar {0}', __($esAdministrador ? 'reserva' : 'pista')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="reserva form large-9 medium-8 columns content">
    <?= $this->Form->create($reserva) ?>
    <fieldset>
        <legend><?= __('Editar {0}', __('reserva')) ?></legend>
        <script>var ultimaFechaSel;</script>
        <?=
            $this->Form->control('fechaInicio', [
                'type' => 'flatpickr_date',
                'label' => __('Fecha y hora'),
                'flatpickrOptions' => [
                    'minDate' => ($esAdministrador ? $hoy->subMonths(2) : $hoy->add(ReservaTable::getIntervaloSoloLectura())->addDay())->getTimestamp() * 1000,
                    'maxDate' => $hoy->add(ReservaTable::getIntervaloSoloLectura())->addMonth()->getTimestamp() * 1000,
                    'onClose' => 'function(fechasSel) { if (fechasSel.length > 0 && fechasSel[0].getTime() <= (new Date(' . $timestampLimiteModificable . ')).getTime() && (ultimaFechaSel === undefined || ultimaFechaSel != fechasSel[0].getTime())) { swal("Aviso", "' . __('La fecha escogida implicará que no se podrá editar o eliminar después. Si eso no es deseable, establece una fecha posterior.') . '", "info", { button: "' . __('De acuerdo') . '" }); ultimaFechaSel = fechasSel[0].getTime(); } }'
                ]
            ])
        ?>
    </fieldset>
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>
