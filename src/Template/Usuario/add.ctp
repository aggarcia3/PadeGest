<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

// Page title
$this->assign('title', __('Gestión de {0}', 'usuarios'));

?>
<div class="usuario form content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <h3 class="card-title text-center"><?= __('Crear usuario') ?></h3>
        <?= $this->Form->create($usuario) ?>
            <?= $this->Form->control('username', ['label' => __('Nombre de usuario')]) ?>
            <?= $this->Form->control('password', ['label' => __('Contraseña')]) ?>
            <?= $this->Form->control('nombre', ['label' => __('Nombre')]) ?>
            <?= $this->Form->control('apellidos', ['label' => __('Apellidos')]); ?>
            <?=
                $this->Form->control('genero', [
                    'label' => __('Género'),
                    'type' => 'select',
                    'options' => [
                        '' => __('Escoge uno'),
                        'masculino' => __('Masculino'),
                        'femenino' => __('Femenino'),
                    ]
                ])
            ?>
            <?=
                $this->Form->control('esSocio', [
                    'label' => __('Es socio'),
                    'type' => 'select',
                    'options' => [
                        '' => __('Escoge una opción'),
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
    </fieldset>
    <?= $this->Form->button(__('Crear'), ['class' => 'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>
