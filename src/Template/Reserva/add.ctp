<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */

use App\Model\Table\ReservaTable;
use App\View\Widget\FlatpickrWidget;
use App\View\Widget\FranjaPickerWidget;

// Page title
$this->assign('title', __('Gestión de {0}', __('reservas')));

// Importar dependencias de Flatpickr y FranjaPicker
FlatpickrWidget::importarDependencias($this);
FranjaPickerWidget::importarDependencias($this);

$esAdministrador = $Auth->user('rol') === 'administrador';

$timestampLimiteModificable = $hoy->add(ReservaTable::getIntervaloSoloLectura())->getTimestamp() * 1000; // Conversión a ms
?>
<div class="reserva form content">
    <?= $this->Form->create($reserva) ?>
    <fieldset>
        <h3 class="card-title text-center"><?= __($esAdministrador ? 'Crear {0}' : 'Reservar {0}', __($esAdministrador ? 'reserva' : 'pista')) ?></h3>
        <?=
            $this->Form->control('fechaInicio', [
                'type' => 'flatpickr_date',
                'label' => __('Fecha'),
                'placeholder' => __('Escoge una fecha'),
                'flatpickrOptions' => [
                    'minDate' => $hoy->add(ReservaTable::getAntelacionCreacion())->getTimestamp() * 1000,
                    'maxDate' => $hoy->add(ReservaTable::getIntervaloSoloLectura())->addMonth()->getTimestamp() * 1000,
                    'onClose' => 'function(fechas, _, _) { if (fechas.length > 0) { actualizarFranjas(fechas[0]); } }'
                ]
            ])
        ?>
        <?=
            $this->Form->control('franja', [
                'type' => 'franja_horaria',
                'label' => __('Hora'),
                'required' => true
            ])
        ?>
        <?php if ($esAdministrador): ?>
        <?=
            $this->Form->control('usuario_id', [
                'options' => $usuario,
                'label' => __('A nombre de'),
                'empty' => __('Escoge un usuario'),
                'required' => true
            ])
        ?>
        <?=
            $this->Form->control('pista_id', [
                'options' => $pista,
                'label' => __('Pista'),
                'empty' => __('Deja en blanco para usar una libre'),
                'required' => false
            ])
        ?>
        <?php endif; ?>
    </fieldset>
    <?= $this->Form->button(__($esAdministrador ? 'Crear' : 'Reservar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
