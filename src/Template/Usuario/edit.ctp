<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Usuario'), ['action' => 'listar']) ?> </li>
    </ul>
</nav>
<div class="usuario form large-9 medium-8 columns content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Edit Usuario') ?></legend>
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
            echo $this->Form->label('Rol');
            echo $this->Form->select('rol', [
                'administrador' => 'Administrador',
                'deportista' => 'Deportista'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
