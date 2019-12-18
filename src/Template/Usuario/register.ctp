<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

// Page title
$this->assign('title', __('Registrarse'));

?>
<div class="container" style="padding-bottom: 0px; margin-bottom:0px;">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center"><?= __('Introduce los datos de tu nueva cuenta') ?></h5>
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
                <?= $this->Form->button(__('Registrarse'), ['class' => 'btn btn-lg btn-primary btn-block']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    </div>
</div>

