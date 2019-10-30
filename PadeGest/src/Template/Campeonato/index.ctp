<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato[]|\Cake\Collection\CollectionInterface $campeonato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Campeonato'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="campeonato index large-9 medium-8 columns content">
    <h3><?= __('Campeonato') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaInicioInscripciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaFinInscripciones') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($campeonato as $campeonato): ?>
            <tr>
                <td><?= $this->Number->format($campeonato->id) ?></td>
                <td><?= h($campeonato->nombre) ?></td>
                <td><?= h($campeonato->fechaInicioInscripciones) ?></td>
                <td><?= h($campeonato->fechaFinInscripciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $campeonato->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $campeonato->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $campeonato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $campeonato->id)]) ?>
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
