<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado[]|\Cake\Collection\CollectionInterface $usuarioPartidoPromocionado
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('usuarioPartidoPromocionado')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Usuario Partido Promocionado')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Usuario')),
                ['controller' => 'Usuario', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Usuario')),
                ['controller' => 'Usuario', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Partido Promocionado')),
                ['controller' => 'PartidoPromocionado', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Partido Promocionado')),
                ['controller' => 'PartidoPromocionado', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="usuarioPartidoPromocionado index large-9 medium-8 columns content">
    <h3><?= __('Usuario Partido Promocionado') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('usuario_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('partido_promocionado_id') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarioPartidoPromocionado as $usuarioPartidoPromocionado): ?>
            <tr>
                <td><?= $usuarioPartidoPromocionado->has('usuario') ? $this->Html->link($usuarioPartidoPromocionado->usuario->id, ['controller' => 'Usuario', 'action' => 'view', $usuarioPartidoPromocionado->usuario->id]) : '' ?></td>
                <td><?= $usuarioPartidoPromocionado->has('partido_promocionado') ? $this->Html->link($usuarioPartidoPromocionado->partido_promocionado->id, ['controller' => 'PartidoPromocionado', 'action' => 'view', $usuarioPartidoPromocionado->partido_promocionado->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['action' => 'view', $usuarioPartidoPromocionado->idUsuario],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['action' => 'edit', $usuarioPartidoPromocionado->idUsuario],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['action' => 'delete', $usuarioPartidoPromocionado->idUsuario],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la usuarioPartidoPromocionado número {0}', $usuarioPartidoPromocionado->idUsuario)])
                            ]
                        )
                    ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{$usuarioPartidoPromocionado}=1{$usuarioPartidoPromocionado} other{$usuarioPartidoPromocionado}}', [count($usuarioPartidoPromocionado)])]) ?></p>
    </div>
</div>
