<?php

use Cake\Routing\Router;

if ($Auth->user('id')): ?>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'PartidoPromocionado', 'action' => 'index']) ?>"><?= __('Partidos promocionados') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Campeonato', 'action' => 'index']) ?>"><?= __('Campeonatos') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Reserva', 'action' => 'index']) ?>"><?= __('Reservas de pistas') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Enfrentamiento', 'action' => 'index']) ?>"><?= __('Enfrentamientos') ?></a></li>

    <?php if ($Auth->user('rol') === "administrador"): ?>

    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Pista', 'action' => 'index']) ?>"><?= __('Pistas') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Usuario', 'action' => 'index']) ?>"><?= __('Usuarios') ?></a></li>

    <?php endif; ?>
    <?php if ($Auth->user('rol') === "deportista"): ?>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Usuario', 'action' => 'hacerseSocio']) ?>"><?= __('Hacerse Socio') ?></a></li>
    <?php endif; ?>
<?php endif; ?>

