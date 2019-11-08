<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */

use Cake\I18n\FrozenTime;

// Page title
$this->assign('title', __('Gestión de {0}', __('reserva')));

$esAdministrador = $auth->user('rol') === 'administrador';
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
        <?= $this->Form->control('fecha', ['type' => 'horareservapicker']) ?>
        <?= $this->Form->control('pista_id', ['options' => $pista]) ?>
    </fieldset>
    <?= $this->Form->button(__($esAdministrador ? 'Crear' : 'Reservar')) ?>
    <?= $this->Form->end() ?>
</div>
