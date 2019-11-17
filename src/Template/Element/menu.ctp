<?php

use Cake\Routing\Router;

if ($Auth->user('id')): ?>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'PartidoPromocionado']) ?>"><?= __('Partidos promocionados') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Campeonato']) ?>"><?= __('Campeonatos') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Reserva']) ?>"><?= __('Reservas de pistas') ?></a></li>
    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Enfrentamiento']) ?>"><?= __('Enfrentamientos') ?></a></li>

    <?php if ($Auth->user('rol') === "administrador"): ?>

    <li><a class="nav-link" href="<?= Router::url(['controller' => 'Usuario']) ?>"><?= __('Usuarios') ?></a></li>

    <?php endif; ?>
<?php endif; ?>
