<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado[]|\Cake\Collection\CollectionInterface $usuarioPartidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Usuario Partido Promocionado'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarioPartidoPromocionado index large-9 medium-8 columns content">
    <h3><?= __('Usuario Partido Promocionado') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('idUsuario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idPartidoPromocionado') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarioPartidoPromocionado as $usuarioPartidoPromocionado): ?>
            <tr>
                <td><?= $this->Number->format($usuarioPartidoPromocionado->idUsuario) ?></td>
                <td><?= $this->Number->format($usuarioPartidoPromocionado->idPartidoPromocionado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usuarioPartidoPromocionado->idUsuario]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usuarioPartidoPromocionado->idUsuario]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usuarioPartidoPromocionado->idUsuario], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioPartidoPromocionado->idUsuario)]) ?>
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
