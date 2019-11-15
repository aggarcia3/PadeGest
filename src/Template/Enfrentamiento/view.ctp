<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enfrentamiento $enfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('enfrentamiento')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-pen-square edit-action-fa-icon"></i> ' . __('Editar {0}', __('Enfrentamiento')),
                ['action' => 'edit', $enfrentamiento->id],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fas fa-minus-square delete-action-fa-icon"></i> ' . __('Eliminar {0}', __('Enfrentamiento')),
                ['action' => 'delete', $enfrentamiento->id],
                ['escapeTitle' => false, 'confirm' =>
                    __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la Enfrentamiento número {0}', $enfrentamiento->id)])
                ]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Enfrentamiento')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Enfrentamiento')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Pareja')),
                ['controller' => 'Pareja', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Pareja')),
                ['controller' => 'Pareja', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Reserva')),
                ['controller' => 'Reserva', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Reserva')),
                ['controller' => 'Reserva', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Resultado')),
                ['controller' => 'Resultado', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Resultado')),
                ['controller' => 'Resultado', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="enfrentamiento view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('enfrentamiento')) . ' ' . h($enfrentamiento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($enfrentamiento->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fase') ?></th>
            <td><?= h($enfrentamiento->fase) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reserva') ?></th>
            <td><?= $enfrentamiento->has('reserva') ? $this->Html->link($enfrentamiento->reserva->id, ['controller' => 'Reserva', 'action' => 'view', $enfrentamiento->reserva->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($enfrentamiento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($enfrentamiento->fecha) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Resultado relacionadas') ?></h4>
        <?php if (!empty($enfrentamiento->resultado)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Enfrentamiento Id') ?></th>
                <th scope="col"><?= __('Set1pareja1') ?></th>
                <th scope="col"><?= __('Set1pareja2') ?></th>
                <th scope="col"><?= __('Set2pareja1') ?></th>
                <th scope="col"><?= __('Set2pareja2') ?></th>
                <th scope="col"><?= __('Set3pareja1') ?></th>
                <th scope="col"><?= __('Set3pareja2') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($enfrentamiento->resultado as $resultado): ?>
            <tr>
                <td><?= h($resultado->enfrentamiento_id) ?></td>
                <td><?= h($resultado->set1pareja1) ?></td>
                <td><?= h($resultado->set1pareja2) ?></td>
                <td><?= h($resultado->set2pareja1) ?></td>
                <td><?= h($resultado->set2pareja2) ?></td>
                <td><?= h($resultado->set3pareja1) ?></td>
                <td><?= h($resultado->set3pareja2) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'view', $resultado->idEnfrentamiento],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'edit', $resultado->idEnfrentamiento],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'delete', $resultado->idEnfrentamiento],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la resultado número {0}', $resultado->idEnfrentamiento)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
