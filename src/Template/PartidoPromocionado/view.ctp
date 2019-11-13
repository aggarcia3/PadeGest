<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar" style="padding-bottom: 0px; margin-bottom:0px;" >
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
<div class="partidoPromocionado view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
<h3 class="card-title text-center" style="color: black;">Partido Promocionado: <?= h($partidoPromocionado->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($partidoPromocionado->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdReserva') ?></th>
            <td><?= $this->Number->format($partidoPromocionado->idReserva) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($partidoPromocionado->fecha) ?></td>
        </tr>
    </table>
    <div class="related">
    <h3 class="card-title text-center" style="color: black;">Usuarios Inscritos</h3>
        <?php if (!empty($partidoPromocionado->usuario)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col"><?= __('Genero') ?></th>
                <th scope="col"><?= __('EsSocio') ?></th>
                <th scope="col"><?= __('Rol') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($partidoPromocionado->usuario as $usuario): ?>
            <tr>
                <td><?= h($usuario->id) ?></td>
                <td><?= h($usuario->username) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td><?= h($usuario->genero) ?></td>
                <td><?php echo ((h($usuario->esSocio) == 1 ) ? "Si" :  "No"); ?></td>
                <td><?= h($usuario->rol) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['controller' => 'Usuario', 'action' => 'view', $usuario->id], ['escapeTitle' => false]) ?>  
                    <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['controller' => 'Usuario', 'action' => 'edit', $usuario->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['controller' => 'Usuario', 'action' => 'delete', $usuario->id], ['escapeTitle' => false, 'confirm' => __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('el usuario {0}', $usuario->username)])]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    </div>
</div>
