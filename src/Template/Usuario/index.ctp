<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

use Cake\Routing\Router;
?>
<div class="container">
    <div class="jumbotron my-4" style="background-image: url('/img/header-padel.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <h1 class="display-3">Bienvenido a PadeGest</h1>
        <p class="lead p-header">Estamos considerados el mejor club de pádel de Ourense, con miles de valoraciones positivas entre numerosos aficionados y profesionales de este deporte. ¡Te invitamos a que nos descubras en nuestra nueva página web!</p>

        <?php if (!$Auth->user('id')) : ?>
            <a href="<?= Router::url(['controller' => 'Usuario', 'action' => 'register']) ?>" class="btn btn-primary btn-lg">¡Regístrate Gratis!</a>
        <?php endif; ?>
    </div>

    <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="/img/padel.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">Campeonatos</h4>
                    <p class="card-text">Tenemos torneos de tres categorías y niveles distintos, para que disfrutes compitiendo.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="/img/images.jpeg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Reserva libre de pistas</h4>
                    <p class="card-text">Reserva una pista de las muchas que tenemos para jugar con tus amigos a tu ritmo, y mejorar cada día.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="/img/promocion.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">Partidos promocionados</h4>
                    <p class="card-text">De vez en cuando promocionamos partidos para mantener activos a nuestros deportistas. ¡Estate atento a las novedades que surjan!</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="/img/podio.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Clasificaciones</h4>
                    <p class="card-text">Competir con deportividad permite poner en práctica lo aprendido. Además, ¡hay premios asegurados para los mejores!</p>
                </div>
            </div>
        </div>

    </div>
</div>
