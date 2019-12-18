<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pareja[]|\Cake\Collection\CollectionInterface $pareja
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pareja'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Enfrentamiento'), ['controller' => 'Enfrentamiento', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Enfrentamiento'), ['controller' => 'Enfrentamiento', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pareja index large-9 medium-8 columns content">
    <h3><?= __('Pareja') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idCapitan') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idCompanero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('categoria_nivel_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grupo_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pareja as $pareja): ?>
            <tr>
                <td><?= $this->Number->format($pareja->id) ?></td>
                <td><?= $this->Number->format($pareja->idCapitan) ?></td>
                <td><?= $this->Number->format($pareja->idCompanero) ?></td>
                <td><?= $this->Number->format($pareja->categoria_nivel_id) ?></td>
                <td><?= $this->Number->format($pareja->grupo_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pareja->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pareja->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pareja->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pareja->id)]) ?>
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
