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
        <?php
            echo $this->Form->control('titulo');
            echo $this->Form->control('cuerpo');
            ?>
            <label for="fecha">Fecha de publicación</label>
            <input type="date" name="fecha">
    </fieldset>
    <?= $this->Form->button(__('Añadir'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
