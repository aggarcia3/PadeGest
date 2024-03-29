<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

use Cake\Routing\Router;

// Page title
$this->assign('title', $Auth->user('id') == $usuario->id ? __('Mi perfil') : __('Gestión de {0}', 'usuarios'));

?>
<div class="usuario view content">
    <h3 class="card-title text-center">
        <?= $Auth->user('id') != $usuario->id ? h($usuario->username) : __('Mi perfil') ?>
        <?php if ($Auth->user('id') == $usuario->id): ?>
            <a href="<?= Router::url(['controller' => 'Usuario', 'action' => 'edit', $usuario->id]) ?>" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-pen-square"></i>
            </a>
        <?php endif; ?>
    </h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre de usuario') ?></th>
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
            <th scope="row"><?= __('Género') ?></th>
            <td><?= __(ucfirst(h($usuario->genero))) ?></td>
        </tr>
        <?php if ($Auth->user('rol') === 'administrador'): ?>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= __(ucfirst(h($usuario->rol))) ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __($Auth->user('rol') === 'administrador' ? 'Es socio' : 'Soy socio') ?></th>
            <td><?= h($usuario->esSocio) == 1 ? "Sí" : "No" ?></td>
        </tr>
    </table>
    <br>
        <br>
    <h3>Inscripciones</h3>
    <table >
    <thead>
    <tr>
            <th scope="row"><?= __('Nombre de la clase') ?></th>
    </tr>
    </thead>
    <?php
    $i = 0;
     foreach($clasesAtendidas as $clases){ ?>
    
       
        <tbody>
        <tr>
            <td ><?= h($clases) ?></td>
        </tr>
        </tbody>
    <?php } ?>
    </table>
        <br>
        <br>

    
    <h3>Pagos Realizados</h3>
    <table >
    <thead>
    <tr>
            <th scope="row"><?= __('Concepto') ?></th>
            <th scope="row"><?= __('Importe') ?></th>
            <th scope="row"><?= __('fecha') ?></th>
    </tr>
    </thead>
    <?php foreach($pagosFinales as $pagos){ ?>
    
       
        <tbody>
        <tr>
            <td ><?= h($pagos->concepto) ?></td>
            <td><?= h($pagos->importe) ?>€</td>
            <td><?= h($pagos->fecha) ?></td>
        </tr>
        </tbody>
    <?php } ?>
    </table>
</div>
