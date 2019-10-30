<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriaNivel $categoriaNivel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Categoria Nivel'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="categoriaNivel form large-9 medium-8 columns content">
    <?= $this->Form->create($categoriaNivel) ?>
    <fieldset>
        <legend><?= __('Add Categoria Nivel') ?></legend>
        <?php
            echo $this->Form->control('categoria');
            echo $this->Form->control('nivel');
            echo $this->Form->control('idCampeonato');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
