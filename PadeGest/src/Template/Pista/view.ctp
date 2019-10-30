<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pistum $pistum
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pistum'), ['action' => 'edit', $pistum->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pistum'), ['action' => 'delete', $pistum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pistum->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pista'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pistum'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pista view large-9 medium-8 columns content">
    <h3><?= h($pistum->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('TipoSuelo') ?></th>
            <td><?= h($pistum->tipoSuelo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TipoCerramiento') ?></th>
            <td><?= h($pistum->tipoCerramiento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Localizacion') ?></th>
            <td><?= h($pistum->localizacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pistum->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Focos') ?></th>
            <td><?= $this->Number->format($pistum->focos) ?></td>
        </tr>
    </table>
</div>
