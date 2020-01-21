<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Noticium $noticium
 */
?>
<div class="noticia form content">
<h3 class="card-title text-center">Añadir Noticia</h3>
    <?= $this->Form->create($noticium) ?>
    <fieldset>
        <?= $this->Form->control('titulo') ?>
        <?= $this->Form->control('cuerpo') ?>
    </fieldset>
    <?= $this->Form->button(__('Añadir'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
