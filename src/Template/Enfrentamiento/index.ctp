<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enfrentamiento[]|\Cake\Collection\CollectionInterface $enfrentamiento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Enfrentamiento'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pareja'), ['controller' => 'Pareja', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pareja'), ['controller' => 'Pareja', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="enfrentamiento index large-9 medium-8 columns content">
    <h3><?= __('Enfrentamiento') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idReserva') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enfrentamiento as $enfrentamiento): ?>
            <tr>
                <td><?= $this->Number->format($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?= $this->Number->format($enfrentamiento->idReserva) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $enfrentamiento->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $enfrentamiento->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enfrentamiento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enfrentamiento->id)]) ?>
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
