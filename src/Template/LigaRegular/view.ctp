<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LigaRegular $ligaRegular
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Liga Regular'), ['action' => 'edit', $ligaRegular->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Liga Regular'), ['action' => 'delete', $ligaRegular->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ligaRegular->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Liga Regular'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Liga Regular'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ligaRegular view large-9 medium-8 columns content">
    <h3><?= h($ligaRegular->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ligaRegular->id) ?></td>
        </tr>
    </table>
</div>
