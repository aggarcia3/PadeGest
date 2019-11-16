<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

use Cake\Routing\Router;
?>
<?= $this->element('menu') ?>
  <!-- Page Content -->
  <div class="large-9 medium-8 columns">

    <!-- Jumbotron Header -->
    <div class="jumbotron my-4" style="background-image: url('/img/header-padel.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <h1 class="display-3">Bienvenido a PadeGest</h1>
      <p class="lead p-header">Estamos considerados el mejor club de pádel de Ourense con miles de valoraciones positivas entre los numerosos aficionados y profesionales de este deporte. ¡Te invitamos a que nos descubras en nuestra nueva página web!</p>

      <?php if(!$Auth->user('id')){ ?>

      <a href="<?= Router::url(['controller' => 'Usuario', 'action' => 'register']) ?>" class="btn btn-primary btn-lg">¡Regístrate Gratis!</a>

      <?php } ?>

    </div>

    <!-- Page Features -->
    <div class="row text-center">

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="/img/padel.png" alt="">
          <div class="card-body">
            <h4 class="card-title">Campeonatos</h4>
            <p class="card-text">Tenemos torneos de tres categorías y niveles distintos, difrútalos cada muy poco tiempo</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="/img/images.jpeg" alt="">
          <div class="card-body">
            <h4 class="card-title">Reserva una Pista</h4>
            <p class="card-text">Reserva una pista de las muchas que tenemos para poder jugar con tus amigos y mejorar cada día más</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="/img/promocion.png" alt="">
          <div class="card-body">
            <h4 class="card-title">Partidos con Promoción</h4>
            <p class="card-text">Tenemos partidos promocionados por el club para mantener activos anuestros deportistas, una ayuda siempre viene bien!</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="/img/podio.jpg" alt="">
          <div class="card-body">
            <h4 class="card-title">Rankings</h4>
            <p class="card-text">Competir de una manera sana permite mejorar y mantener una rivalidad amigable, permios asegurados a los primeros todos los meses</p>
          </div>
        </div>
      </div>

    </div>
    <!-- /.row -->

  </div>


</body>

</html>
