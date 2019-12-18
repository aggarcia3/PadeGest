<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reserva $reserva
 */

use App\Model\Table\ReservaTable;

// Page title
$this->assign('title', __('Gestión de {0}', __('reservas')));

$modificable = ReservaTable::esModificable($reserva);

$esAdministrador = $Auth->user('rol') === 'administrador';
?>
<div class="reserva view content">
    <h3 class="card-title text-center">
        <?= __('Detalles de la {0}', __('reserva')) . ' número ' . h($reserva->id) ?>
    </h3>
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
