<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<?= $this->element('menu') ?>
<div class="usuario form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <h3 class="card-title text-center" style="color: black;">Editar Usuario</h3>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password', array('required' => false));
            echo $this->Form->label('Dejar la contraseña en blanco para no cambiar');
            echo $this->Form->control('nombre');
            echo $this->Form->control('apellidos');
            echo $this->Form->label('Genero');
            echo $this->Form->select('genero', [
                'masculino' => 'Masculino',
                'femenino' => 'Femenino'
            ]);
            if($this->request->session()->read('Auth.User.rol') == "administrador"){
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
            }
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Editar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
