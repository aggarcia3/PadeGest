<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Usuario'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reserva'), ['controller' => 'Reserva', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reserva'), ['controller' => 'Reserva', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuario form large-9 medium-8 columns content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Add Usuario') ?></legend>
        <?php
            echo $this->Form->control('login');
            echo $this->Form->control('password');
            echo $this->Form->control('nombre');
            echo $this->Form->control('apellidos');
            echo $this->Form->control('genero');
            echo $this->Form->control('esSocio');
            echo $this->Form->control('rol');
            echo $this->Form->control('partido_promocionado._ids', ['options' => $partidoPromocionado]);
            echo $this->Form->control('reserva._ids', ['options' => $reserva]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
