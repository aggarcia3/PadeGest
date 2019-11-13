<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
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
<div class="usuario view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
<h3 class="card-title text-center" style="color: black;"><?= h($usuario->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($usuario->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($usuario->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($usuario->apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genero') ?></th>
            <td><?= h($usuario->genero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= h($usuario->rol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EsSocio') ?></th>
            <td><?php echo ((h($usuario->esSocio) == 1 ) ? "Si" :  "No"); ?></td>
        </tr>
        
    </table>
</div>
