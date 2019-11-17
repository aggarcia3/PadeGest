<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="usuario form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <h3 class="card-title text-center">Añadir Usuario</h3>
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
    <?= $this->Form->button(__('Añadir'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
