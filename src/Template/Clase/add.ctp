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
            echo $this->Form->control('nombre', ['required' => true]);
            echo $this->Form->control('plazasMin', ['required' => true]);
            echo $this->Form->control('plazasMax', ['required' => true]);
            echo $this->Form->control('frecuenciaSemanas', ['required' => true]);
            echo $this->Form->control('fechaInicioInscripcion', ['required' => true]);
            echo $this->Form->control('fechaFinInscripcion', ['required' => true]);
            echo $this->Form->control('semanasDuracion', ['required' => true]);
            echo $this->Form->control('horaInicio', ['required' => true]);
            echo $this->Form->control('usuario', ['options' => $usuario , 'value' => $usuario , 'required' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Crear clase'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
