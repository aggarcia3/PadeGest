<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="usuario form content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <h3 class="card-title text-center" style="color: black;">Hacerse Socio</h3>
        <?php
            echo $this->Form->label('Socio');
            echo $this->Form->select('esSocio', [
                1 => 'Si',
                0 => 'No'
            ]);
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>