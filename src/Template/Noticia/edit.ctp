<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Noticium $noticium
 */
?>
<div class="noticia form content">
    <?= $this->Form->create($noticium) ?>
    <fieldset>
    <h3 class="card-title text-center">Editar Noticia: <?= h($noticium->titulo) ?> </h3>
        <?= $this->Form->control('titulo') ?>
        <?= $this->Form->control('cuerpo') ?>
    </fieldset>
    <?= $this->Form->button(__('Editar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
    
</div>
