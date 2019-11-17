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
            echo $this->Form->control('fechaInicioInscripciones');
            echo $this->Form->control('fechaFinInscripciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Añadir'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
