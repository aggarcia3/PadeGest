<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado $resultado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Resultado'), ['action' => 'edit', $resultado->idEnfrentamiento]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Resultado'), ['action' => 'delete', $resultado->idEnfrentamiento], ['confirm' => __('Are you sure you want to delete # {0}?', $resultado->idEnfrentamiento)]) ?> </li>
        <li><?= $this->Html->link(__('List Resultado'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Resultado'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="resultado view large-9 medium-8 columns content">
    <h3><?= h($resultado->idEnfrentamiento) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('IdEnfrentamiento') ?></th>
            <td><?= $this->Number->format($resultado->idEnfrentamiento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set1pareja1') ?></th>
            <td><?= $this->Number->format($resultado->set1pareja1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set1pareja2') ?></th>
            <td><?= $this->Number->format($resultado->set1pareja2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set2pareja1') ?></th>
            <td><?= $this->Number->format($resultado->set2pareja1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set2pareja2') ?></th>
            <td><?= $this->Number->format($resultado->set2pareja2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set3pareja1') ?></th>
            <td><?= $this->Number->format($resultado->set3pareja1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set3pareja2') ?></th>
            <td><?= $this->Number->format($resultado->set3pareja2) ?></td>
        </tr>
    </table>
</div>
