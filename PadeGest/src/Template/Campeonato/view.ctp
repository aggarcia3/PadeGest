<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Campeonato'), ['action' => 'edit', $campeonato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Campeonato'), ['action' => 'delete', $campeonato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $campeonato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Campeonato'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Campeonato'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="campeonato view large-9 medium-8 columns content">
    <h3><?= h($campeonato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($campeonato->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($campeonato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaInicioInscripciones') ?></th>
            <td><?= h($campeonato->fechaInicioInscripciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaFinInscripciones') ?></th>
            <td><?= h($campeonato->fechaFinInscripciones) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Bases') ?></h4>
        <?= $this->Text->autoParagraph(h($campeonato->bases)); ?>
    </div>
</div>
