<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuario'), ['action' => 'edit', $usuario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuario'), ['action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuario'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partido Promocionado'), ['controller' => 'PartidoPromocionado', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reserva'), ['controller' => 'Reserva', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reserva'), ['controller' => 'Reserva', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuario view large-9 medium-8 columns content">
    <h3><?= h($usuario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Login') ?></th>
            <td><?= h($usuario->login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($usuario->password) ?></td>
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
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usuario->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EsSocio') ?></th>
            <td><?= $this->Number->format($usuario->esSocio) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Partido Promocionado') ?></h4>
        <?php if (!empty($usuario->partido_promocionado)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('IdReserva') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->partido_promocionado as $partidoPromocionado): ?>
            <tr>
                <td><?= h($partidoPromocionado->id) ?></td>
                <td><?= h($partidoPromocionado->fecha) ?></td>
                <td><?= h($partidoPromocionado->idReserva) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PartidoPromocionado', 'action' => 'view', $partidoPromocionado->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PartidoPromocionado', 'action' => 'edit', $partidoPromocionado->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PartidoPromocionado', 'action' => 'delete', $partidoPromocionado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partidoPromocionado->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Reserva') ?></h4>
        <?php if (!empty($usuario->reserva)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('IdPista') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->reserva as $reserva): ?>
            <tr>
                <td><?= h($reserva->id) ?></td>
                <td><?= h($reserva->fecha) ?></td>
                <td><?= h($reserva->idPista) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reserva', 'action' => 'view', $reserva->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reserva', 'action' => 'edit', $reserva->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reserva', 'action' => 'delete', $reserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reserva->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
