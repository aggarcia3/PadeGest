<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
use Cake\I18n\Time;
Time::setDefaultLocale('es-ES');
Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
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
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($partidoPromocionado->nombre) ?></td>
        </tr>
        <tr>

<?php
            $fechaInscribirse =  new Time($partidoPromocionado->fecha);
            $fechaInscribirse->subDays(2);
?>

            <th scope="row"><?= __('Fecha del partido') ?></th>
            <td><?= h(new Time($partidoPromocionado->fecha)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha final de Inscripcion') ?></th>
            <td><?= h($fechaInscribirse) ?></td>
        </tr>
    </table>

    <?= $this->Form->create(false, array(
    'url' => array('controller' => 'usuarioPartidoPromocionado', 'action' => 'add'))) ?>
        <fieldset>
            <?= $this->Form->input('partido_promocionado_id', ['type' => 'hidden', 'default'=>$partidoPromocionado->id])?>
        </fieldset>
    <?= $this->Form->button(__('Inscribirse'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
