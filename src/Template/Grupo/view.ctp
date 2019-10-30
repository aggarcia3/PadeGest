<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grupo'), ['action' => 'edit', $grupo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grupo'), ['action' => 'delete', $grupo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grupo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grupo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grupo'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grupo view large-9 medium-8 columns content">
    <h3><?= h($grupo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grupo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdCategoriaNivel') ?></th>
            <td><?= $this->Number->format($grupo->idCategoriaNivel) ?></td>
        </tr>
    </table>
</div>
