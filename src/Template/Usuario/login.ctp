<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>

<div class="usuario form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?php
            echo $this->Form->control('login');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <a href="/usuario/register">aun no estas registrado?</a>
</div>