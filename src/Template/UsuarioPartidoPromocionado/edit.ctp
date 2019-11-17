<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsuarioPartidoPromocionado $usuarioPartidoPromocionado
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('usuarioPartidoPromocionado')));
?>
<?= $this->element('menu') ?>
<div class="usuarioPartidoPromocionado form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($usuarioPartidoPromocionado) ?>
    <fieldset>
        <legend><?= __('Edit Usuario Partido Promocionado') ?></legend>
        <?php
            echo $this->Form->control('usuario_id', ['options' => $usuario]);
            echo $this->Form->control('partido_promocionado_id', ['options' => $partidoPromocionado]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
