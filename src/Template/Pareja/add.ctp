<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pareja $pareja
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pareja'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Enfrentamiento'), ['controller' => 'Enfrentamiento', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Enfrentamiento'), ['controller' => 'Enfrentamiento', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pareja form large-9 medium-8 columns content">
    <?= $this->Form->create($pareja) ?>
    <fieldset>
        <legend><?= __('Add Pareja') ?></legend>
        <?php
            echo $this->Form->control('idCapitan');
            echo $this->Form->control('idCompanero');
            echo $this->Form->control('idCategoriaNivel');
            echo $this->Form->control('idGrupo');
            echo $this->Form->control('enfrentamiento._ids', ['options' => $enfrentamiento]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
