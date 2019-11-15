<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('grupo')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $grupo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $grupo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Grupo'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categoria Nivel'), ['controller' => 'CategoriaNivel', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Categoria Nivel'), ['controller' => 'CategoriaNivel', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pareja'), ['controller' => 'Pareja', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pareja'), ['controller' => 'Pareja', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grupo form large-9 medium-8 columns content">
    <?= $this->Form->create($grupo) ?>
    <fieldset>
        <legend><?= __('Edit Grupo') ?></legend>
        <?php
            echo $this->Form->control('categoria_nivel_id', ['options' => $categoriaNivel]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
