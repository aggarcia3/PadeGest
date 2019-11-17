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

$timestampLimiteModificable = $hoy->add(ReservaTable::getIntervaloSoloLectura())->getTimestamp() * 1000; // Conversión a ms
?>
<?= $this->element('menu') ?>
<div class="reserva form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($reserva) ?>
    <fieldset>
        <legend><?= __('Editar {0}', __('reserva')) ?></legend>
        <script>var ultimaFechaSel;</script>
        <?=
            $this->Form->control('fechaInicio', [
                'type' => 'flatpickr_date',
                'label' => __('Fecha y hora'),
                'flatpickrOptions' => [
                    'minDate' => $reserva->fechaFin->getTimestamp() * 1000,
                    'maxDate' => $hoy->add(ReservaTable::getIntervaloSoloLectura())->addMonth()->getTimestamp() * 1000
                ]
            ])
        ?>
    </fieldset>
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>
