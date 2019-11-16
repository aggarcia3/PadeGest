<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>
<?= $this->element('menu') ?>
<div class="campeonato form large-9 medium-8 columns content">
    <?= $this->Form->create($campeonato) ?>
    <fieldset>
    <h3 class="card-title text-center">Editar Campeonato: <?= h($campeonato->nombre) ?> </h3>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('bases');
            echo $this->Form->control('fechaInicioInscripciones');
            echo $this->Form->control('fechaFinInscripciones');
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Editar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
