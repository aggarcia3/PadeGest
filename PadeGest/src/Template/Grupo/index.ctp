<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo[]|\Cake\Collection\CollectionInterface $grupo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Grupo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grupo index large-9 medium-8 columns content">
    <h3><?= __('Grupo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idCategoriaNivel') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupo as $grupo): ?>
            <tr>
                <td><?= $this->Number->format($grupo->id) ?></td>
                <td><?= $this->Number->format($grupo->idCategoriaNivel) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $grupo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $grupo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grupo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grupo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
