<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clase $clase
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('clase')));
?>
<div class="clase view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('clase')) . ' ' . h($clase->id) ?></h3>
    <table class="vertical-table">
    </table>
    <div class="related">
        <h4><?= __('Usuario relacionadas') ?></h4>
        <?php if (!empty($clase->usuario)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col"><?= __('Genero') ?></th>
                <th scope="col"><?= __('EsSocio') ?></th>
                <th scope="col"><?= __('Rol') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($clase->usuario as $usuario): ?>
            <tr>
                <td><?= h($usuario->id) ?></td>
                <td><?= h($usuario->username) ?></td>
                <td><?= h($usuario->password) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td><?= h($usuario->genero) ?></td>
                <td><?= h($usuario->esSocio) ?></td>
                <td><?= h($usuario->rol) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Usuario', 'action' => 'view', $usuario->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'Usuario', 'action' => 'edit', $usuario->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'Usuario', 'action' => 'delete', $usuario->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la usuario número {0}', $usuario->id)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Reserva relacionadas') ?></h4>
        <?php if (!empty($clase->reserva)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('FechaInicio') ?></th>
                <th scope="col"><?= __('FechaFin') ?></th>
                <th scope="col"><?= __('Pista Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Clase Id') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($clase->reserva as $reserva): ?>
            <tr>
                <td><?= h($reserva->id) ?></td>
                <td><?= h($reserva->fechaInicio) ?></td>
                <td><?= h($reserva->fechaFin) ?></td>
                <td><?= h($reserva->pista_id) ?></td>
                <td><?= h($reserva->usuario_id) ?></td>
                <td><?= h($reserva->clase_id) ?></td>
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
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
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
        <?php endif; ?>
    </div>
</div>
