<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Log in</h5>
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create() ?>
                <div class="form-label-group">
                        <?= $this->Form->input('username') ?>
                </div>
                <div class="form-label-group">
                        <?= $this->Form->input('password') ?>
                </div>
              <?= $this->Form->button(__('Login'), array('class' => 'btn btn-lg btn-primary btn-block')); ?>
            <?= $this->Form->end() ?>
            <div class="cajaTextoRegistrarse">
                <label class="tagRegistrarse">aun no estas registrado?</label>
            </div>
                <a class="btn btn-lg btn-secondary btn-block" href="/usuario/register">Resgístrate Aquí</a> 
            </div>
        </div>
    </div>
  </div>
</div>