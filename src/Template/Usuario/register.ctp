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
                <h5 class="card-title text-center">Registrarse</h5>
                <?= $this->Form->create() ?>
                    <div class="form-label-group">
                        <?php echo $this->Form->control('username'); ?>
                    </div>
                    <div class="form-label-group">
                        <?php echo $this->Form->control('password'); ?>
                    </div>
                    <div class="form-label-group">
                        <?php echo $this->Form->control('nombre'); ?>
                    </div>
                    <div class="form-label-group">
                        <?php echo $this->Form->control('apellidos'); ?>
                    </div>
                    <div class="form-label-group">
                        <?php   echo $this->Form->label('Genero');
                                echo $this->Form->select('genero', [
                                    'masculino' => 'Masculino',
                                    'femenino' => 'Femenino'
                                ]);
                        ?>
                    </div>
                <?= $this->Form->button(__('Registrarse'), array('class' => 'btn btn-lg btn-primary btn-block')); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    </div>
</div>

