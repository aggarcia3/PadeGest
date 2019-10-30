<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reserva'), ['action' => 'edit', $reserva->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reserva'), ['action' => 'delete', $reserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reserva'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reserva'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuario'), ['controller' => 'Usuario', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuario', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reserva view large-9 medium-8 columns content">
    <h3><?= h($reserva->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reserva->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdPista') ?></th>
            <td><?= $this->Number->format($reserva->idPista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($reserva->fecha) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Usuario') ?></h4>
        <?php if (!empty($reserva->usuario)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Login') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col"><?= __('Genero') ?></th>
                <th scope="col"><?= __('EsSocio') ?></th>
                <th scope="col"><?= __('Rol') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reserva->usuario as $usuario): ?>
            <tr>
                <td><?= h($usuario->id) ?></td>
                <td><?= h($usuario->login) ?></td>
                <td><?= h($usuario->password) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td><?= h($usuario->genero) ?></td>
                <td><?= h($usuario->esSocio) ?></td>
                <td><?= h($usuario->rol) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Usuario', 'action' => 'view', $usuario->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Usuario', 'action' => 'edit', $usuario->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Usuario', 'action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
