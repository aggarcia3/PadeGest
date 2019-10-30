<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LigaRegular $ligaRegular
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ligaRegular->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ligaRegular->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Liga Regular'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ligaRegular form large-9 medium-8 columns content">
    <?= $this->Form->create($ligaRegular) ?>
    <fieldset>
        <legend><?= __('Edit Liga Regular') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
