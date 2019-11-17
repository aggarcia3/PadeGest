<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="usuario view content">
<h3 class="card-title text-center"><?= h($usuario->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($usuario->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($usuario->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($usuario->apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genero') ?></th>
            <td><?= h($usuario->genero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= h($usuario->rol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EsSocio') ?></th>
            <td><?php echo ((h($usuario->esSocio) == 1 ) ? "Si" :  "No"); ?></td>
        </tr>

    </table>
</div>
