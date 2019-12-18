<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParejaEnfrentamiento $parejaEnfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('parejaEnfrentamiento')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $parejaEnfrentamiento->idEnfrentamiento],
                ['confirm' => __('Are you sure you want to delete # {0}?', $parejaEnfrentamiento->idEnfrentamiento)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pareja Enfrentamiento'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="parejaEnfrentamiento form large-9 medium-8 columns content">
    <?= $this->Form->create($parejaEnfrentamiento) ?>
    <fieldset>
        <legend><?= __('Edit Pareja Enfrentamiento') ?></legend>
        <?php
            echo $this->Form->control('pareja_id');
            echo $this->Form->control('enfrentamiento_id');
            echo $this->Form->control('participacionConfirmada');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
