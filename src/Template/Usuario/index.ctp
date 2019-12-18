<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario[]|\Cake\Collection\CollectionInterface $usuarios
 */

use Cake\Routing\Router;

// Page title
$this->assign('title', __('Gestión de {0}', 'usuarios'));

?>
<div class="usuario index content thead-dark">
    <h3 class="card-title text-center">
        <?= __('Usuarios del club') ?>
        <a href="<?= Router::url(['controller' => 'Usuario', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-right">
            <i class="fas fa-user-plus"></i>
        </a>
    </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('username', __('Nombre de usuario')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre', __('Nombre')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellidos', __('Apellidos')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('genero', __('Género')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('esSocio', __('Es socio')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('rol', __('Rol')) ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= h($usuario->username) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td><?= __(ucfirst(h($usuario->genero))) ?></td>
                <td><?= h($usuario->esSocio) == 1 ? "Sí" : "No" ?></td>
                <td><?= __(ucfirst(h($usuario->rol))) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['action' => 'view', $usuario->id], ['escapeTitle' => false]) ?>
                    <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['action' => 'edit', $usuario->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['action' => 'delete', $usuario->id], ['escapeTitle' => false, 'confirm' => __('¿Estás seguro de que quieres eliminar el usuario "{0}"? Esto borrará toda su información asociada.', [__('{0}', $usuario->username)])]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{usuarios}=1{usuario} other{usuarios}}', [count($usuarios)])]) ?></p>
    </div>
</div>
