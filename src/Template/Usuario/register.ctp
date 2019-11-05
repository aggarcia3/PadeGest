<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="usuario form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add Usuario') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('nombre');
            echo $this->Form->control('apellidos');
            echo $this->Form->label('Genero');
            echo $this->Form->select('genero', [
                'masculino' => 'Masculino',
                'femenino' => 'Femenino'
            ]);
            echo $this->Form->label('Socio');
            echo $this->Form->select('esSocio', [
                0 => 'Si',
                1 => 'No'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
