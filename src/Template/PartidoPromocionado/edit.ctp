<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar Partido Promocionado'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="partidoPromocionado form large-9 medium-8 columns content">
    <?= $this->Form->create($partidoPromocionado) ?>
    <fieldset>
        <legend><?= __('Edit Partido Promocionado') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('fecha');
            echo $this->Form->control('usuario._ids', ['options' => $usuario]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
