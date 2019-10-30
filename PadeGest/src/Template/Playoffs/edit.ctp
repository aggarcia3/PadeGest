<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playoff $playoff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $playoff->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $playoff->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Playoffs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="playoffs form large-9 medium-8 columns content">
    <?= $this->Form->create($playoff) ?>
    <fieldset>
        <legend><?= __('Edit Playoff') ?></legend>
        <?php
            echo $this->Form->control('idLigaRegular');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
