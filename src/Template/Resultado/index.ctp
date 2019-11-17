<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado[]|\Cake\Collection\CollectionInterface $resultado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Nuevo Resultado'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="resultado index large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= __('Resultado') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('idEnfrentamiento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('set1pareja1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('set1pareja2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('set2pareja1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('set2pareja2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('set3pareja1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('set3pareja2') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $resultado): ?>
            <tr>
                <td><?= $this->Number->format($resultado->idEnfrentamiento) ?></td>
                <td><?= $this->Number->format($resultado->set1pareja1) ?></td>
                <td><?= $this->Number->format($resultado->set1pareja2) ?></td>
                <td><?= $this->Number->format($resultado->set2pareja1) ?></td>
                <td><?= $this->Number->format($resultado->set2pareja2) ?></td>
                <td><?= $this->Number->format($resultado->set3pareja1) ?></td>
                <td><?= $this->Number->format($resultado->set3pareja2) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $resultado->idEnfrentamiento]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resultado->idEnfrentamiento]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resultado->idEnfrentamiento], ['confirm' => __('Are you sure you want to delete # {0}?', $resultado->idEnfrentamiento)]) ?>
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
