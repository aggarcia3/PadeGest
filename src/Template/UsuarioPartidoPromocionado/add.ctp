<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado $usuarioPartidoPromocionado
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('usuarioPartidoPromocionado')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Usuario Partido Promocionado'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Usuario'), ['controller' => 'Usuario', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuario', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarioPartidoPromocionado form large-9 medium-8 columns content">
    <?= $this->Form->create($usuarioPartidoPromocionado) ?>
    <fieldset>
        <legend><?= __('Add Usuario Partido Promocionado') ?></legend>
        <?php
            echo $this->Form->control('usuario_id', ['options' => $usuario]);
            echo $this->Form->control('partido_promocionado_id', ['options' => $partidoPromocionado]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
