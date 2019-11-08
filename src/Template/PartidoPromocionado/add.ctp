<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar Partido Promocionado'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="partidoPromocionado form large-9 medium-8 columns content">
    <?= $this->Form->create($partidoPromocionado) ?>
    <fieldset>
        <legend><?= __('Crear Partido Promocionado') ?></legend>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>
