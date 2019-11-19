<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado[]|\Cake\Collection\CollectionInterface $partidoPromocionado
 */
?>
<?= $this->element('menu') ?>
<div class="partidoPromocionado index large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">

<?php if($Auth->user('rol') == "administrador"){ ?>

    <h3 class="card-title text-center" style="color: black;">Partidos Promocionados<a href="/partido-promocionado/add" class="btn btn-primary btn-sm float-right">Añadir Partido Promocionado</a></h3>


<?php }else{ ?>

    <h3 class="card-title text-center" style="color: black;">Partidos Promocionados</h3>

<?php }?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>


<?php if($Auth->user('rol') == "administrador"){ ?>

                <th scope="col"><?= $this->Paginator->sort('id', 'Id del Partido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idReserva', 'Id de la Reserva') ?></th>

<?php } ?>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha', 'Fecha del partido') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidoPromocionado as $partidoPromocionado):
                if ($partidoPromocionado->id != ""): ?>
            <tr>

<?php if($Auth->user('rol') == "administrador"){ ?>

                    <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
                    <td><?php echo (h($partidoPromocionado->reserva_id) == "") ? "No hay reserva de pista" : h($partidoPromocionado->reserva_id); ?></td>

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
                <?php endif; ?>
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
