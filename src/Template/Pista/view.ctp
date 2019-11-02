<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $pista
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('pistas')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-pen-square edit-action-fa-icon"></i> ' . __('Editar {0}', __('pista')),
                ['action' => 'edit', $pista->id],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fas fa-minus-square delete-action-fa-icon"></i> ' . __('Eliminar {0}', __('pista')),
                ['action' => 'delete', $pista->id],
                ['escapeTitle' => false, 'confirm' =>
                    __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la pista número {0}', $pista->id)])
                ]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('pistas')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('pista')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('reservas')),
                ['controller' => 'Reserva', 'action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-calendar-plus add-action-fa-icon"></i> ' . __('Crear {0}', __('reserva')),
                ['controller' => 'Reserva', 'action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="pista view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('pista')) . ' número ' . h($pista->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tipo de suelo') ?></th>
            <td><?= ucfirst(h(__($pista->tipoSuelo))) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo de cerramiento') ?></th>
            <td><?= ucfirst(h(__($pista->tipoCerramiento)))  ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Localización') ?></th>
            <td><?= ucfirst(h(__($pista->localizacion))) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Número de focos') ?></th>
            <td><?= $this->Number->format($pista->focos) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Reservas asociadas') ?></h4>
        <?php if (!empty($pista->reserva)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Número de reserva') ?></th>
                <th scope="col"><?= __('Fecha y hora') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($pista->reserva as $reserva): ?>
            <tr>
                <td><?= h($reserva->id) ?></td>
                <td><?= h($reserva->fecha) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Reserva', 'action' => 'view', $reserva->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'Reserva', 'action' => 'edit', $reserva->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-calendar-minus delete-action-fa-icon"></i>',
                            ['controller' => 'Reserva', 'action' => 'delete', $reserva->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la reserva número {0}', $reserva->id)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <h5><?= __('No hay {0} asociadas a esta {1}.', __('reservas'), __('pista')) ?></h5>
        <?php endif; ?>
    </div>
</div>
