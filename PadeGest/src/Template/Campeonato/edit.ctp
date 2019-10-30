<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $campeonato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $campeonato->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Campeonato'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="campeonato form large-9 medium-8 columns content">
    <?= $this->Form->create($campeonato) ?>
    <fieldset>
        <legend><?= __('Edit Campeonato') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('bases');
            echo $this->Form->control('fechaInicioInscripciones');
            echo $this->Form->control('fechaFinInscripciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
