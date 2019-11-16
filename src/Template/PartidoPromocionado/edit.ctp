<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<?= $this->element('menu') ?>

<div class="partidoPromocionado form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($partidoPromocionado) ?>
    <fieldset>
        <h3 class="card-title text-center">Editar Partido Promocionado</h3>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('fecha');
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Actualizar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
