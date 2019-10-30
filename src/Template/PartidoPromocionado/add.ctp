<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Usuario'), ['controller' => 'Usuario', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuario', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="partidoPromocionado form large-9 medium-8 columns content">
    <?= $this->Form->create($partidoPromocionado) ?>
    <fieldset>
        <legend><?= __('Add Partido Promocionado') ?></legend>
        <?php
            echo $this->Form->control('fecha');
            echo $this->Form->control('idReserva');
            echo $this->Form->control('usuario._ids', ['options' => $usuario]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
