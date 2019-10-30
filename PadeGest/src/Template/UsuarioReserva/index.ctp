<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioReserva[]|\Cake\Collection\CollectionInterface $usuarioReserva
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Usuario Reserva'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarioReserva index large-9 medium-8 columns content">
    <h3><?= __('Usuario Reserva') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('idUsuario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idReserva') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarioReserva as $usuarioReserva): ?>
            <tr>
                <td><?= $this->Number->format($usuarioReserva->idUsuario) ?></td>
                <td><?= $this->Number->format($usuarioReserva->idReserva) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usuarioReserva->idUsuario]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usuarioReserva->idUsuario]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usuarioReserva->idUsuario], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioReserva->idUsuario)]) ?>
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
