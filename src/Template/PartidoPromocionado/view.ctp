<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="partidoPromocionado view large-9 medium-8 columns content">
    <h3><?= h($partidoPromocionado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
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
        <h4><?= __('Usuarios Inscritos') ?></h4>
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
