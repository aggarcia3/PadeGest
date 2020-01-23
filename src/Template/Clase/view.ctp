<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clase $clase
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('clases')));

$esAdministrador = $Auth->user('rol') === 'administrador';

?>
<div class="clase view content">
    <h3 class="card-title text-center">
        <?= __('Clase') . ' ' . h($clase->nombre) ?>
    </h3>
    <table class="vertical-table">
    </table>
    <div class="related">
        <h4><?= __('Alumnos') ?></h4>
        <?php if (!empty($clase->usuario)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nombre de usuario') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($clase->usuario as $usuario): ?>
            <tr>
                <td><?= h($usuario->username) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td class="actions">
                    <?php if ($esAdministrador): ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Usuario', 'action' => 'view', $usuario->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?php endif; ?>
                    <?=
                        $this->Html->link(
                            '<i class="fas fa-envelope add-action-fa-icon"></i>',
                            ['action' => 'mensaje', $clase->id, $usuario->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <h5><?= __('No hay alumnos inscritos todavía.') ?></h5>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Reservas de pistas') ?></h4>
        <?php if (!empty($clase->reserva)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Número de reserva') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Número de pista') ?></th>
            </tr>
            <?php foreach ($clase->reserva as $reserva): ?>
            <tr>
                <td><?= h($reserva->id) ?></td>
                <td><?= h($reserva->fechaInicio) ?></td>
                <td><?= $reserva->pista_id ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
        <h5><?= __('Esta clase no tiene pistas reservadas todavía.') ?></h5>
        <?php endif; ?>
    </div>
</div>
