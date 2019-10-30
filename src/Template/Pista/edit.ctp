<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pistum $pistum
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pistum->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pistum->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pista'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pista form large-9 medium-8 columns content">
    <?= $this->Form->create($pistum) ?>
    <fieldset>
        <legend><?= __('Edit Pistum') ?></legend>
        <?php
            echo $this->Form->control('tipoSuelo');
            echo $this->Form->control('tipoCerramiento');
            echo $this->Form->control('localizacion');
            echo $this->Form->control('focos');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
