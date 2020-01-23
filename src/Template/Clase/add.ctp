<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clase $clase
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('clase')));
?>
<div class="clase form content">
    <?= $this->Form->create($clase) ?>
    <fieldset>
        <h3 class="card-title text-center" style="color: black;">Crear Clase Deportiva</h3>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('plazasMin');
            echo $this->Form->control('plazasMax');
            echo $this->Form->control('frecuencia');
            echo $this->Form->control('fechaInicioInscripcion');
            echo $this->Form->control('fechaFinInscripcion');
            echo $this->Form->control('semanasDuracion');
            echo $this->Form->control('horaInicio');
            echo $this->Form->control('id del entrenador', ['options' => $usuario]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Crear clase'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
