<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('reserva')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reserva->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reserva'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pista'), ['controller' => 'Pista', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pistum'), ['controller' => 'Pista', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuario'), ['controller' => 'Usuario', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuario', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Enfrentamiento'), ['controller' => 'Enfrentamiento', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Enfrentamiento'), ['controller' => 'Enfrentamiento', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reserva form large-9 medium-8 columns content">
    <?= $this->Form->create($reserva) ?>
    <fieldset>
        <legend><?= __('Edit Reserva') ?></legend>
        <?php
            echo $this->Form->control('fecha');
            echo $this->Form->control('pista_id', ['options' => $pista]);
            echo $this->Form->control('usuario_id', ['options' => $usuario, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
