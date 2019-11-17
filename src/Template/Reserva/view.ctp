<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */

use Cake\ORM\TableRegistry;

// Page title
$this->assign('title', __('Gestión de {0}', __('reservas')));

$modificable = TableRegistry::getTableLocator()->get('Reserva')->esModificable($reserva);

$esAdministrador = $Auth->user('rol') === 'administrador';
?>
<?= $this->element('menu') ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <?php if ($esAdministrador && $modificable): ?>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-pen-square edit-action-fa-icon"></i> ' . __('Editar {0}', __('reserva')),
                ['action' => 'edit', $reserva->id],
                ['escapeTitle' => false]
            )
        ?></li>
        <?php endif; ?>
        <?php if ($modificable): ?>
        <li><?=
            $this->Form->postLink(
                '<i class="fas fa-calendar-minus delete-action-fa-icon"></i> ' . __($esAdministrador ? 'Eliminar {0}' : 'Cancelar {0}', __('reserva')),
                ['action' => 'delete', $reserva->id],
                ['escapeTitle' => false, 'confirm' =>
                    __('¿Estás seguro de que quieres ' . ($esAdministrador ? 'eliminar' : 'cancelar') . ' {0}? Esto borrará toda su información asociada.', [__('la reserva número {0}', $reserva->id)])
                ]
            )
        ?></li>
        <?php endif; ?>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver ' . ($esAdministrador ? '' : 'mis ') . '{0}', __('reservas')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?=
            $this->Html->link(
                '<i class="fas fa-calendar-plus add-action-fa-icon"></i> ' . __($esAdministrador ? 'Crear {0}' : 'Reservar {0}', __($esAdministrador ? 'reserva' : 'pista')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="reserva view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= __('Detalles de la {0}', __('reserva')) . ' número ' . h($reserva->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Pista') ?></th>
            <td>
            <?php if ($esAdministrador): ?>
            <?=
                $this->Html->link(
                    ucfirst(__(h($reserva->pista->localizacion))) . ', ' . __('número') . ' ' . $reserva->pista->id,
                    ['controller' => 'Pista', 'action' => 'view', $reserva->pista->id]
                )
            ?>
            <?php else: ?>
            <span><?=
                ucfirst(__(h($reserva->pista->localizacion))) . ', ' . __('número') . ' ' . $reserva->pista->id
            ?></span>
            <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($reserva->fechaInicio) ?></td>
        </tr>
        <?php if ($esAdministrador): ?>
        <tr>
            <th scope="row"><?= __('Reservado por') ?></th>
            <?php if ($reserva->has('usuario')): ?>
                <td><?=
                    $this->Html->link(
                        $reserva->usuario->nombre . ' ' . $reserva->usuario->apellidos . ' (' . $reserva->usuario->username . ')',
                        ['controller' => 'Usuario', 'action' => 'view', $reserva->usuario->id]
                    )
                ?></td>
                <?php elseif ($reserva->has('enfrentamiento')): ?>
                <td><?=
                    $this->Html->link(
                        __('Enfrentamiento') . ': '. $reserva->enfrentamiento->nombre,
                        ['controller' => 'Enfrentamiento', 'action' => 'view', $reserva->enfrentamiento->id]
                    )
                ?></td>
                <?php elseif ($reserva->has('partido_promocionado')): ?>
                <td><?=
                    $this->Html->link(
                        __('Partido promocionado') . ': ' . $reserva->partido_promocionado->nombre,
                        ['controller' => 'PartidoPromocionado', 'action' => 'view', $reserva->partido_promocionado->id]
                    )
                ?></td>
                <?php else: ?>
                <td>No disponible</td>
                <?php endif; ?>
            <td>
        </tr>
        <?php endif; ?>
    </table>
</div>
