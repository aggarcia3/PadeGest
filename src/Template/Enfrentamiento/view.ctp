<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enfrentamiento $enfrentamiento
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Enfrentamiento'), ['action' => 'edit', $enfrentamiento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Enfrentamiento'), ['action' => 'delete', $enfrentamiento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enfrentamiento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Enfrentamiento'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Enfrentamiento'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pareja'), ['controller' => 'Pareja', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pareja'), ['controller' => 'Pareja', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="enfrentamiento view large-9 medium-8 columns content">
    <h3><?= h($enfrentamiento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($enfrentamiento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdReserva') ?></th>
            <td><?= $this->Number->format($enfrentamiento->idReserva) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($enfrentamiento->fecha) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Pareja') ?></h4>
        <?php if (!empty($enfrentamiento->pareja)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('IdCapitan') ?></th>
                <th scope="col"><?= __('IdCompanero') ?></th>
                <th scope="col"><?= __('IdCategoriaNivel') ?></th>
                <th scope="col"><?= __('IdGrupo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($enfrentamiento->pareja as $pareja): ?>
            <tr>
                <td><?= h($pareja->id) ?></td>
                <td><?= h($pareja->idCapitan) ?></td>
                <td><?= h($pareja->idCompanero) ?></td>
                <td><?= h($pareja->idCategoriaNivel) ?></td>
                <td><?= h($pareja->idGrupo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pareja', 'action' => 'view', $pareja->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pareja', 'action' => 'edit', $pareja->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pareja', 'action' => 'delete', $pareja->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pareja->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
