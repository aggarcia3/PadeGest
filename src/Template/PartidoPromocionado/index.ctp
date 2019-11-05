<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado[]|\Cake\Collection\CollectionInterface $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

<?php if($this->request->session()->read('Auth.User.rol') == "deportista"){ ?>

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
    <h3><?= __('Partido Promocionado') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>


<?php if($this->request->session()->read('Auth.User.rol') == "administrador"){ ?>

                <th scope="col"><?= $this->Paginator->sort('id') ?></th>

<?php } ?>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idReserva') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partidoPromocionado as $partidoPromocionado): ?>
            <tr>
                <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
                <td><?= h($partidoPromocionado->fecha) ?></td>
                <td><?= $this->Number->format($partidoPromocionado->idReserva) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $partidoPromocionado->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partidoPromocionado->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partidoPromocionado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partidoPromocionado->id)]) ?>

<?php if($this->request->session()->read('Auth.User.rol') == "deportista"){ ?>

                    <?= $this->Form->postLink(__('Inscribirse'), ['action' => 'inscribirse', $partidoPromocionado->id]) ?>

<?php } ?>

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
