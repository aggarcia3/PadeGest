<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playoff $playoff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Playoffs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="playoffs form large-9 medium-8 columns content">
    <?= $this->Form->create($playoff) ?>
    <fieldset>
        <legend><?= __('Add Playoff') ?></legend>
        <?php
            echo $this->Form->control('idLigaRegular');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
