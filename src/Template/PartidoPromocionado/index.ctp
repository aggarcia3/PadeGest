<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado[]|\Cake\Collection\CollectionInterface $partidoPromocionado
 */

use Cake\Routing\Router;

?>
<div class="partidoPromocionado index content">

<?php if($Auth->user('rol') == "administrador"){ ?>

    <h3 class="card-title text-center">Partidos Promocionados<a href="<?= Router::url(['controller' => 'PartidoPromocionado', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-right">Añadir Partido Promocionado</a></h3>


<?php }else{ ?>

    <h3 class="card-title text-center">Partidos Promocionados</h3>

<?php }?>

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
                    <td><?php if($this->Number->format($partidoPromocionado->idReserva)== 0){ echo "No hay reserva de Pista"; }else{ echo $this->Number->format($partidoPromocionado->idReserva); } ?></td>

<?php } ?>

                <td><?= h($partidoPromocionado->nombre) ?></td>
                <td><?= h($partidoPromocionado->fecha) ?></td>
                <td class="actions">

<?php if($Auth->user('rol') == "deportista"){ ?>

                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i> Inscribirse', ['action' => 'inscribirse', $partidoPromocionado->id], ['escapeTitle' => false]) ?>
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
