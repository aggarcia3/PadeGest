<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado $usuarioPartidoPromocionado
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('usuarioPartidoPromocionado')));
?>
<?= $this->element('menu') ?>
<div class="usuarioPartidoPromocionado view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
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
