<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario[]|\Cake\Collection\CollectionInterface $usuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Partido Promocionados'), ['controller' => 'PartidoPromocionado', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Enfrentamientos Restantes'), ['controller' => 'Enfrentamiento', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Campeonatos'), ['controller' => 'Campeonato', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Reservas de Pistas'), ['controller' => 'Reserva', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Playoffs'), ['controller' => 'Playoffs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuario', 'action' => 'listar']) ?></li>
    </ul>
</nav>
<div class="usuario index large-9 medium-8 columns content">
    <h3><?= __('Usuario') ?><em> </em>
    <a href="/usuario/add">Añadir</a></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('esSocio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rol') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuario as $usuario): ?>
            <tr>
                <td><?= h($usuario->username) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td><?= h($usuario->genero) ?></td>
                <td><?php echo ((h($usuario->esSocio) == 1 ) ? "Si" :  "No"); ?></td>
                <td><?= h($usuario->rol) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['action' => 'view', $usuario->id], ['escapeTitle' => false]) ?>  
                    <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['action' => 'edit', $usuario->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['action' => 'delete', $usuario->id], ['escapeTitle' => false, 'confirm' => __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('el usuario {0}', $usuario->username)])]) ?>
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
