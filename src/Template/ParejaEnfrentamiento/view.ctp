<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParejaEnfrentamiento $parejaEnfrentamiento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pareja Enfrentamiento'), ['action' => 'edit', $parejaEnfrentamiento->idEnfrentamiento]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pareja Enfrentamiento'), ['action' => 'delete', $parejaEnfrentamiento->idEnfrentamiento], ['confirm' => __('Are you sure you want to delete # {0}?', $parejaEnfrentamiento->idEnfrentamiento)]) ?> </li>
        <li><?= $this->Html->link(__('List Pareja Enfrentamiento'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pareja Enfrentamiento'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parejaEnfrentamiento view large-9 medium-8 columns content">
    <h3><?= h($parejaEnfrentamiento->idEnfrentamiento) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('IdPareja') ?></th>
            <td><?= $this->Number->format($parejaEnfrentamiento->idPareja) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdEnfrentamiento') ?></th>
            <td><?= $this->Number->format($parejaEnfrentamiento->idEnfrentamiento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ParticipacionConfirmada') ?></th>
            <td><?= $this->Number->format($parejaEnfrentamiento->participacionConfirmada) ?></td>
        </tr>
    </table>
</div>
