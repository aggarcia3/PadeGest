<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado[]|\Cake\Collection\CollectionInterface $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar" style="padding-bottom: 0px; margin-bottom:0px;">
    <ul class="side-nav ">

<?php if($this->request->session()->read('Auth.User.id') && $this->request->session()->read('Auth.User.rol') == "administrador"){ ?>

<?= $this->Html->link(__('Partidos Promocionados'), ['controller' => 'PartidoPromocionado', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Enfrentamientos Restantes'), ['controller' => 'Enfrentamiento', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Campeonatos'), ['controller' => 'Campeonato', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Reservas de Pistas'), ['controller' => 'Reserva', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Playoffs'), ['controller' => 'Playoffs', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuario', 'action' => 'listar'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>

<?php }else if($this->request->session()->read('Auth.User.id') && $this->request->session()->read('Auth.User.rol') == "deportista"){ ?> 

<?= $this->Html->link(__('Partidos Promocionados'), ['controller' => 'PartidoPromocionado', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Enfrentamientos Restantes'), ['controller' => 'Enfrentamiento', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Campeonatos'), ['controller' => 'Campeonato', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Reservas de Pistas'), ['controller' => 'Reserva', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>
<?= $this->Html->link(__('Playoffs'), ['controller' => 'Playoffs', 'action' => 'index'], array('class' => 'list-group-item list-group-item-action bg-light')) ?>

<?php } ?> 

    </ul>
</nav>
<div class="partidoPromocionado index large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">

<?php if($this->request->session()->read('Auth.User.rol') == "administrador"){ ?>

    <h3 class="card-title text-center" style="color: black;">Partidos Promocionados<a href="/partido-promocionado/add" class="btn btn-primary btn-sm float-right">Añadir Partido Promocionado</a></h3>


<?php }else{ ?>

    <h3 class="card-title text-center" style="color: black;">Partidos Promocionados</h3>

<?php }?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>


<?php if($this->request->session()->read('Auth.User.rol') == "administrador"){ ?>

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

<?php if($this->request->session()->read('Auth.User.rol') == "administrador"){ ?>

                    <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
                    <td><?php if($this->Number->format($partidoPromocionado->idReserva)== 0){ echo "No hay reserva de Pista"; }else{ echo $this->Number->format($partidoPromocionado->idReserva); } ?></td>

<?php } ?>
                
                <td><?= h($partidoPromocionado->nombre) ?></td>
                <td><?= h($partidoPromocionado->fecha) ?></td>
                <td class="actions">

<?php if($this->request->session()->read('Auth.User.rol') == "deportista"){ ?>

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
