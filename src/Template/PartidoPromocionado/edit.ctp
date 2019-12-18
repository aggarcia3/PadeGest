<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<div class="partidoPromocionado form content">
    <?= $this->Form->create($partidoPromocionado) ?>
    <fieldset>
        <h3 class="card-title text-center">Editar Partido Promocionado</h3>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('fecha');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Actualizar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
