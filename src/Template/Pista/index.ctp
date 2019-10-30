<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pistum[]|\Cake\Collection\CollectionInterface $pista
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pistum'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pista index large-9 medium-8 columns content">
    <h3><?= __('Pista') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipoSuelo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipoCerramiento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('localizacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('focos') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pista as $pistum): ?>
            <tr>
                <td><?= $this->Number->format($pistum->id) ?></td>
                <td><?= h($pistum->tipoSuelo) ?></td>
                <td><?= h($pistum->tipoCerramiento) ?></td>
                <td><?= h($pistum->localizacion) ?></td>
                <td><?= $this->Number->format($pistum->focos) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pistum->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pistum->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pistum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pistum->id)]) ?>
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
