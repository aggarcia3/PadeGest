<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioReserva $usuarioReserva
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Usuario Reserva'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="usuarioReserva form large-9 medium-8 columns content">
    <?= $this->Form->create($usuarioReserva) ?>
    <fieldset>
        <legend><?= __('Add Usuario Reserva') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
