<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado $resultado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Resultado'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="resultado form large-9 medium-8 columns content">
    <?= $this->Form->create($resultado) ?>
    <fieldset>
        <legend><?= __('Add Resultado') ?></legend>
        <?php
            echo $this->Form->control('set1pareja1');
            echo $this->Form->control('set1pareja2');
            echo $this->Form->control('set2pareja1');
            echo $this->Form->control('set2pareja2');
            echo $this->Form->control('set3pareja1');
            echo $this->Form->control('set3pareja2');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
