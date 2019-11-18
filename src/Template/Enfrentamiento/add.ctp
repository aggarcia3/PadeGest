<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enfrentamiento $enfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('enfrentamiento')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Enfrentamiento'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reserva'), ['controller' => 'Reserva', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reserva'), ['controller' => 'Reserva', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Resultado'), ['controller' => 'Resultado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Resultado'), ['controller' => 'Resultado', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pareja'), ['controller' => 'Pareja', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pareja'), ['controller' => 'Pareja', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="enfrentamiento form large-9 medium-8 columns content">
    <?= $this->Form->create($enfrentamiento) ?>
    <fieldset>
        <legend><?= __('Add Enfrentamiento') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('fecha');
            echo $this->Form->control('reserva_id', ['options' => $reserva, 'empty' => true]);
            echo $this->Form->control('pareja._ids', ['options' => $pareja]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
