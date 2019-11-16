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
        <h3 class="card-title text-center">Crear Partido Promocionado</h3>
            <?php
                echo $this->Form->control('nombre');
            ?>
            <label for="fecha">Fecha del Partido</label>
            <input type="date" name="fecha">

            <?php
                $horas = ['9:00' => '9:00', '10:30' => '10:30', '12:00' => '12:00', '13:30' => '13:30', '15:00' => '15:00', '16:30' => '16:30', '18:00' => '18:00', '19:30' => '19:30'];
                echo $this->Form->label('hora');
                echo $this->Form->select('hora', $horas);
            ?>

    </fieldset>
    <br>
    <?= $this->Form->button(__('Crear'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>

</div>
