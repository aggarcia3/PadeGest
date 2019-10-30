<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playoff $playoff
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Playoff'), ['action' => 'edit', $playoff->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Playoff'), ['action' => 'delete', $playoff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playoff->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Playoffs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Playoff'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="playoffs view large-9 medium-8 columns content">
    <h3><?= h($playoff->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($playoff->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdLigaRegular') ?></th>
            <td><?= $this->Number->format($playoff->idLigaRegular) ?></td>
        </tr>
    </table>
</div>
