<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

// Page title
$this->assign('title', $Auth->user('id') == $usuario->id ? __('Mi perfil') : __('Gestión de {0}', 'usuarios'));

?>
<div class="usuario form content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <h3 class="card-title text-center"><?= $Auth->user('rol') === 'administrador' ? __('Editar usuario') : __('Mi perfil') ?></h3>
        <?= $this->Form->control('username', ['label' => __('Nombre de usuario')]) ?>
        <?= $this->Form->control('password', ['label' => __('Contraseña (déjala en blanco para no cambiar)'), 'value' => '', 'required' => false]) ?>
        <?= $this->Form->control('nombre', ['label' => __('Nombre')]) ?>
        <?= $this->Form->control('apellidos', ['label' => __('Apellidos')]) ?>
        <?=
            $this->Form->control('genero', [
                'label' => __('Género'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge uno'),
                    'masculino' => __('Masculino'),
                    'femenino' => __('Femenino')
                ]
            ])
        ?>
        <?php if ($Auth->user('rol') === 'administrador'): ?>
        <?=
            $this->Form->control('esSocio', [
                'label' => __('Es socio'),
                'type' => 'select',
                'options' => [
                    0 => __('No'),
                    1 => __('Sí')
                ]
            ])
        ?>
        <?=
            $this->Form->control('rol', [
                'label' => __('Rol'),
                'type' => 'select',
                'options' => [
                    'deportista' => __('Deportista'),
                    'administrador' => __('Administrador')
                ]
            ])
        ?>
        <?php endif; ?>
    </fieldset>
    <?= $this->Form->button(__('Editar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
