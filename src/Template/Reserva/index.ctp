<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva[]|\Cake\Collection\CollectionInterface $reserva
 */

use Cake\ORM\TableRegistry;

// Page title
$this->assign('title', __('Gestión de {0}', __('reservas')));

$esAdministrador = $Auth->user('rol') === 'administrador';

$necesarioGenerarColumnaAcciones = $esAdministrador;
$htmlFilasReservas = '';

foreach ($reserva as $reservaAct) {
    $modificable = TableRegistry::getTableLocator()->get('Reserva')->esModificable($reservaAct);

    ob_start();

    ?>
        <tr>
            <td><?= $this->Number->format($reservaAct->id) ?></td>
            <td><?= !$modificable ? '<b>' : '' ?><?= h($reservaAct->fechaInicio) ?><?= !$modificable ? '</b>' : '' ?></td>
            <td>
            <?php if ($esAdministrador): ?>
            <?=
                $this->Html->link(
                    ucfirst(__(h($reservaAct->pista->localizacion))) . ', ' . __('número') . ' ' . $reservaAct->pista->id,
                    ['controller' => 'Pista', 'action' => 'view', $reservaAct->pista->id]
                )
            ?>
            <?php else: ?>
            <span><?=
                ucfirst(__(h($reservaAct->pista->localizacion))) . ', ' . __('número') . ' ' . $reservaAct->pista->id
            ?></span>
            <?php endif; ?>
            </td>
            <?php if ($esAdministrador): ?>
            <?php if ($reservaAct->has('usuario')): ?>
            <td><?=
                $this->Html->link(
                    $reservaAct->usuario->nombre . ' ' . $reservaAct->usuario->apellidos . ' (' . $reservaAct->usuario->username . ')',
                    ['controller' => 'Usuario', 'action' => 'view', $reservaAct->usuario->id]
                )
            ?></td>
            <?php elseif ($reservaAct->has('enfrentamiento')): ?>
            <td><?=
                $this->Html->link(
                    __('Enfrentamiento') . ': '. $reservaAct->enfrentamiento->nombre,
                    ['controller' => 'Enfrentamiento', 'action' => 'view', $reservaAct->enfrentamiento->id]
                )
            ?></td>
            <?php elseif ($reservaAct->has('partido_promocionado')): ?>
            <td><?=
                $this->Html->link(
                    __('Partido promocionado') . ': ' . $reservaAct->partido_promocionado->nombre,
                    ['controller' => 'PartidoPromocionado', 'action' => 'view', $reservaAct->partido_promocionado->id]
                )
            ?></td>
            <?php else: ?>
            <td>No disponible</td>
            <?php endif; ?>
            <?php endif; ?>
            <?php if ($necesarioGenerarColumnaAcciones || $modificable): ?>
            <td class="actions">
                <?php if ($esAdministrador): ?>
                <?=
                    $this->Html->link(
                        '<i class="fas fa-eye view-action-fa-icon"></i>',
                        ['action' => 'view', $reservaAct->id],
                        ['escapeTitle' => false]
                    )
                ?>
                <?php endif; ?>
                <?php if ($esAdministrador && $modificable): ?>
                <?=
                    $this->Html->link(
                        '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                        ['action' => 'edit', $reservaAct->id],
                        ['escapeTitle' => false]
                    )
                ?>
                <?php endif; ?>
                <?php if ($modificable): ?>
                <?=
                    $this->Form->postLink(
                        '<i class="fas fa-calendar-minus delete-action-fa-icon"></i>',
                        ['action' => 'delete', $reservaAct->id],
                        ['escapeTitle' => false, 'confirm' =>
                            __($esAdministrador ? '¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.' : '¿Estás seguro de que quieres cancelar la reserva {0}?', __('la reserva número {0}', $reservaAct->id))
                        ]
                    )
                ?>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
    <?php

    $htmlFilasReservas .= ob_get_clean();
    $necesarioGenerarColumnaAcciones = $necesarioGenerarColumnaAcciones || $modificable;
}
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-calendar-plus add-action-fa-icon"></i> ' . __($esAdministrador ? 'Crear {0}' : 'Reservar {0}', __($esAdministrador ? 'reserva' : 'pista')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="reserva index large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= __($esAdministrador ? 'Reservas en el sistema' : 'Mis reservas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', __('Número de reserva')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha', __('Fecha y hora')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('pista_id', __('Pista')) ?></th>
                <?php if ($esAdministrador): ?>
                <th scope="col"><?= __('Reservado por') ?></th>
                <?php endif; ?>
                <?php if ($necesarioGenerarColumnaAcciones): ?>
                <th scope="col" class="actions"></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?= $htmlFilasReservas ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{reservas}=1{reserva} other{reservas}}', [count($reserva)])]) ?></p>
    </div>
</div>
