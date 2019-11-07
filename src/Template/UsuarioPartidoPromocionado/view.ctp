<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado $usuarioPartidoPromocionado
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('usuarioPartidoPromocionado')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-pen-square edit-action-fa-icon"></i> ' . __('Editar {0}', __('Usuario Partido Promocionado')),
                ['action' => 'edit', $usuarioPartidoPromocionado->idUsuario],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fas fa-minus-square delete-action-fa-icon"></i> ' . __('Eliminar {0}', __('Usuario Partido Promocionado')),
                ['action' => 'delete', $usuarioPartidoPromocionado->idUsuario],
                ['escapeTitle' => false, 'confirm' =>
                    __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la Usuario Partido Promocionado número {0}', $usuarioPartidoPromocionado->idUsuario)])
                ]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Usuario Partido Promocionado')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
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
<div class="usuarioPartidoPromocionado view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('usuarioPartidoPromocionado')) . ' ' . h($usuarioPartidoPromocionado->idUsuario) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $usuarioPartidoPromocionado->has('usuario') ? $this->Html->link($usuarioPartidoPromocionado->usuario->id, ['controller' => 'Usuario', 'action' => 'view', $usuarioPartidoPromocionado->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partido Promocionado') ?></th>
            <td><?= $usuarioPartidoPromocionado->has('partido_promocionado') ? $this->Html->link($usuarioPartidoPromocionado->partido_promocionado->id, ['controller' => 'PartidoPromocionado', 'action' => 'view', $usuarioPartidoPromocionado->partido_promocionado->id]) : '' ?></td>
        </tr>
    </table>
</div>
