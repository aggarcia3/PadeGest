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

$esAdministrador = $Auth->user('rol') === 'administrador';

$timestampLimiteModificable = $hoy->add(ReservaTable::getIntervaloSoloLectura())->getTimestamp() * 1000; // Conversión a ms
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver ' . ($esAdministrador ? '' : 'mis ') . '{0}', __('reservas')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <?php if ($esAdministrador): ?>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('pistas')),
                ['controller' => 'Pista', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('pista')),
                ['controller' => 'Pista', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <?php endif; ?>
    </ul>
</nav>
<div class="reserva form large-9 medium-8 columns content">
    <?= $this->Form->create($reserva) ?>
    <fieldset>
        <legend><?= __($esAdministrador ? 'Crear {0}' : 'Reservar {0}', __($esAdministrador ? 'reserva' : 'pista')) ?></legend>
        <script>var ultimaFechaSel;</script>
        <?=
            $this->Form->control('fechaInicio', [
                'type' => 'flatpickr_date',
                'label' => __('Fecha y hora'),
                'flatpickrOptions' => [
                    'minDate' => $hoy->addDays(7)->getTimestamp() * 1000,
                    'maxDate' => $hoy->add(ReservaTable::getIntervaloSoloLectura())->addMonth()->getTimestamp() * 1000
                ]
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
        <?php endif; ?>
        <?php if ($esAdministrador): ?>
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
    <?= $this->Form->button(__($esAdministrador ? 'Crear' : 'Reservar')) ?>
    <?= $this->Form->end() ?>
</div>
