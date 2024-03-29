<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

use Cake\Routing\Router;

// Page title
$this->assign('title', __('Conectarse'));

?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center"><?= __('Conéctate para usar nuestros servicios') ?></h5>
                    <?= $this->Flash->render('auth') ?>
                    <?= $this->Form->create() ?>
                    <div class="form-label-group">
                        <?= $this->Form->control('username', ['label' => __('Nombre de usuario')]) ?>
                    </div>
                    <div class="form-label-group">
                        <?= $this->Form->control('password', ['label' => __('Contraseña')]) ?>
                    </div>
                    <?= $this->Form->button(__('Conectarse'), array('class' => 'btn btn-lg btn-secondary btn-block')); ?>
                    <?= $this->Form->end() ?>
                    <div class="cajaTextoRegistrarse">
                        <label class="tagRegistrarse"><?= __('¿Todavía no te has registrado?') ?></label>
                    </div>
                    <a class="btn btn-lg btn-primary btn-block" href="<?= Router::url(['controller' => 'Usuario', 'action' => 'register']) ?>"><?= __('Resgístrate ahora') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
