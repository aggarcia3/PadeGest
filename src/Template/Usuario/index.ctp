<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario[]|\Cake\Collection\CollectionInterface $usuario
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
