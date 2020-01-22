<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clase $clase
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('clase')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Clase'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reserva'), ['controller' => 'Reserva', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reserva'), ['controller' => 'Reserva', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuario'), ['controller' => 'Usuario', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuario', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clase form large-9 medium-8 columns content">
    <?= $this->Form->create($clase) ?>
    <fieldset>
        <legend><?= __('Add Clase') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('plazasMin');
            echo $this->Form->control('plazasMax');
            echo $this->Form->control('frecuencia');
            echo $this->Form->control('fechaInicioInscripcion');
            echo $this->Form->control('fechaFinInscripcion');
            echo $this->Form->control('semanasDuracion');
            echo $this->Form->control('horaInicio');
            echo $this->Form->control('usuario._ids', ['options' => $usuario]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
