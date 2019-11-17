<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriaNivel[]|\Cake\Collection\CollectionInterface $categoriaNivel
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nueva Categoria Nivel'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categoriaNivel index large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= __('Categoria Nivel') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('categoria') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nivel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idCampeonato') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoriaNivel as $categoriaNivel): ?>
            <tr>
                <td><?= $this->Number->format($categoriaNivel->id) ?></td>
                <td><?= h($categoriaNivel->categoria) ?></td>
                <td><?= h($categoriaNivel->nivel) ?></td>
                <td><?= $this->Number->format($categoriaNivel->idCampeonato) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $categoriaNivel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $categoriaNivel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $categoriaNivel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriaNivel->id)]) ?>
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
