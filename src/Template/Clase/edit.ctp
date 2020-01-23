<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clase $clase
 */

// Page title

?>
<div class="clase form content">
    <?= $this->Form->create($clase) ?>
    <fieldset>
        <h3 class="card-title text-center"><?= $Auth->user('rol') === 'administrador' ? __('Editar clase') : __('Mi perfil') ?></h3>
        <?= $this->Form->control('nombre', ['label' => __('Nombre de clase')]) ?>
        <?= $this->Form->control('plazasMin', ['label' => __('Numero de plazas minimo')]) ?>
        <?= $this->Form->control('plazasMax', ['label' => __('Numero de plazas maximo')]) ?>
        <?= $this->Form->control('frecuencia', ['label' => __('Frecuencia  (en días)')]) ?>
        <?= $this->Form->control('fechaInicioInscripcion', ['label' => __('Fecha de inicio de inscripcion')]) ?>
        <?= $this->Form->control('fechaFinInscripcion', ['label' => __('Fecha de Fin de inscripcion')]) ?>
        <?= $this->Form->control('semanasDuracion', ['label' => __('Semanas que durara la Clase')]) ?>
        <?= $this->Form->control('horaInicio', ['label' => __('Hora de inicio de la clase')]) ?>
    </fieldset>
    <?= $this->Form->button(__('Editar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
