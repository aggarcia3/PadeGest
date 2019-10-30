<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado $usuarioPartidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Usuario Partido Promocionado'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="usuarioPartidoPromocionado form large-9 medium-8 columns content">
    <?= $this->Form->create($usuarioPartidoPromocionado) ?>
    <fieldset>
        <legend><?= __('Add Usuario Partido Promocionado') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
