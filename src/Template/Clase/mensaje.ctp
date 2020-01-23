<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="mensaje form content">
<h3 class="card-title text-center"><?= __('Escribir mensaje') ?></h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('texto', ['type' => 'textarea', 'label' => 'Texto', 'required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
