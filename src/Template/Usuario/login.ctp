<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

use Cake\Routing\Router;

?>
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
    <legend><?= __('Introduce tus credenciales para conectarte') ?>:</legend>
        <?= $this->Form->control('username', ['label' => __('Nombre de usuario')]) ?>
        <?= $this->Form->control('password', ['label' => __('Contraseña')]) ?>
    </fieldset>
<?= $this->Form->button(__('Conectarse')); ?>
<?= $this->Form->end() ?>
<a href="<?= Router::url(['controller' => 'Usuario', 'action' => 'register']) ?>"><?= __('¿No tienes una cuenta? Regístrate ahora')?></a>
</div>
