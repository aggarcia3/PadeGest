<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriaNivel $categoriaNivel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categoria Nivel'), ['action' => 'edit', $categoriaNivel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categoria Nivel'), ['action' => 'delete', $categoriaNivel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriaNivel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categoria Nivel'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria Nivel'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categoriaNivel view large-9 medium-8 columns content">
    <h3><?= h($categoriaNivel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= h($categoriaNivel->categoria) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nivel') ?></th>
            <td><?= h($categoriaNivel->nivel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($categoriaNivel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdCampeonato') ?></th>
            <td><?= $this->Number->format($categoriaNivel->idCampeonato) ?></td>
        </tr>
    </table>
</div>
