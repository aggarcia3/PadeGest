<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioReserva $usuarioReserva
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuario Reserva'), ['action' => 'edit', $usuarioReserva->idUsuario]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuario Reserva'), ['action' => 'delete', $usuarioReserva->idUsuario], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioReserva->idUsuario)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuario Reserva'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario Reserva'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuarioReserva view large-9 medium-8 columns content">
    <h3><?= h($usuarioReserva->idUsuario) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('IdUsuario') ?></th>
            <td><?= $this->Number->format($usuarioReserva->idUsuario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdReserva') ?></th>
            <td><?= $this->Number->format($usuarioReserva->idReserva) ?></td>
        </tr>
    </table>
</div>
