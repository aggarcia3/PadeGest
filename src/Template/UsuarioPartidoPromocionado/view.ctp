<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado $usuarioPartidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuario Partido Promocionado'), ['action' => 'edit', $usuarioPartidoPromocionado->idUsuario]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuario Partido Promocionado'), ['action' => 'delete', $usuarioPartidoPromocionado->idUsuario], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarioPartidoPromocionado->idUsuario)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuario Partido Promocionado'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario Partido Promocionado'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuarioPartidoPromocionado view large-9 medium-8 columns content">
    <h3><?= h($usuarioPartidoPromocionado->idUsuario) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('IdUsuario') ?></th>
            <td><?= $this->Number->format($usuarioPartidoPromocionado->idUsuario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdPartidoPromocionado') ?></th>
            <td><?= $this->Number->format($usuarioPartidoPromocionado->idPartidoPromocionado) ?></td>
        </tr>
    </table>
</div>
