<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>
<div class="campeonato form content">
<h3 class="card-title text-center">Añadir Campeonato</h3>
    <?= $this->Form->create($campeonato) ?>
    <fieldset>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('bases');
            ?>
            <label for="fecha">Fecha de Inicio de Inscripciones</label>
            <input type="date" name="fechaInicioInscripciones">
            <label for="fecha">Fecha de Fin de Inscripciones</label>
            <input type="date" name="fechaFinInscripciones">
    </fieldset>
    <?= $this->Form->button(__('Añadir'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
