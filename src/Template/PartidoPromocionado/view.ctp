<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<div class="partidoPromocionado view content">
<h3 class="card-title text-center">Partido Promocionado: <?= h($partidoPromocionado->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id del Partido') ?></th>
            <td><?= $this->Number->format($partidoPromocionado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre del Partido') ?></th>
            <td><?= h($partidoPromocionado->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id de la Reserva de pista') ?></th>
            <td><?php echo (h($partidoPromocionado->reserva_id) == "") ? "No hay reserva de pista" : h($partidoPromocionado->reserva_id); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha del Partido') ?></th>
            <td><?= h($partidoPromocionado->fecha) ?></td>
        </tr>
    </table>
    <div class="related">
    <h3 class="card-title text-center">Usuarios Inscritos</h3>
        <?php if (!empty($partidoPromocionado->usuario)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id del Usuario') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellidos') ?></th>
                <th scope="col"><?= __('Genero') ?></th>
                <th scope="col"><?= __('Socio') ?></th>
                <th scope="col"><?= __('Rol') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($partidoPromocionado->usuario as $usuario): ?>
            <tr>
                <td><?= h($usuario->id) ?></td>
                <td><?= h($usuario->username) ?></td>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->apellidos) ?></td>
                <td><?= h($usuario->genero) ?></td>
                <td><?php echo ((h($usuario->esSocio) == 1 ) ? "Si" :  "No"); ?></td>
                <td><?= h($usuario->rol) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['controller' => 'Usuario', 'action' => 'view', $usuario->id], ['escapeTitle' => false]) ?>
                    <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['controller' => 'Usuario', 'action' => 'edit', $usuario->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['controller' => 'Usuario', 'action' => 'delete', $usuario->id], ['escapeTitle' => false, 'confirm' => __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('el usuario "{0}"', $usuario->username)])]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    </div>
</div>
