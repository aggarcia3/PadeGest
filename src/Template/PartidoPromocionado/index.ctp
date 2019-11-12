<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado[]|\Cake\Collection\CollectionInterface $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

<?php if($Auth->user('rol') == "deportista"){ ?>

    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Partido Promocionados'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Enfrentamientos Restantes'), ['controller' => 'Enfrentamiento', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Campeonatos'), ['controller' => 'Campeonato', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Reservas de Pistas'), ['controller' => 'Reserva', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Playoffs'), ['controller' => 'Playoffs', 'action' => 'index']) ?></li>
    </ul>


<?php }else{ ?>

    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Partido Promocionados'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Enfrentamientos Restantes'), ['controller' => 'Enfrentamiento', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Campeonatos'), ['controller' => 'Campeonato', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Reservas de Pistas'), ['controller' => 'Reserva', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Playoffs'), ['controller' => 'Playoffs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuario', 'action' => 'listar']) ?></li>
    </ul>

<?php } ?>

</nav>
<div class="usuario index large-9 medium-8 columns content">
</div>
<div class="partidoPromocionado index large-9 medium-8 columns content">
    <h3><?= __('Partido Promocionado') ?><em> </em><a href="/partido-promocionado/add">Añadir</a></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>


<?php if($Auth->user('rol') == "administrador"){ ?>

                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idReserva') ?></th>

<?php } ?>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidoPromocionado as $partidoPromocionado): ?>
            <tr>

<?php if($Auth->user('rol') == "administrador"){ ?>

                    <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
                    <td><?= $this->Number->format($partidoPromocionado->idReserva) ?></td>

<?php } ?>

                <td><?= h($partidoPromocionado->nombre) ?></td>
                <td><?= h($partidoPromocionado->fecha) ?></td>
                <td class="actions">

<?php if($Auth->user('rol') == "deportista"){ ?>

                    <?= $this->Form->postLink(__('Inscribirse'), ['action' => 'inscribirse', $partidoPromocionado->id]) ?>

<?php } else { ?>

                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>', ['action' => 'view', $partidoPromocionado->id], ['escapeTitle' => false]) ?>
                    <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['action' => 'edit', $partidoPromocionado->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['action' => 'delete', $partidoPromocionado->id], ['escapeTitle' => false, 'confirm' => __('¿Quieres eliminar el Partido Promocionado "{0}"?', $partidoPromocionado->nombre)]) ?>

<?php }  ?>

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
