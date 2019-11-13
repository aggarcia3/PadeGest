<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
if($this->request->session()->read('Auth.User.id')){
    $rutaEditarPerfil = "/usuario/edit/".$this->request->session()->read('Auth.User.id');
}
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        PadeGest:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base') ?>
    <?= $this->Html->css('style') ?>
    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->css('heroic-features') ?>
    <?= $this->Html->script(['bootstrap.min', 'jquery-2.2.4.min']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/usuario/index">Padegest</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

<?php if($this->request->session()->read('Auth.User.id')){ ?> 

                <li><a class="nav-link" href="<?php echo $rutaEditarPerfil?>"><?php echo ($this->request->session()->read('Auth.User.username')); ?></a></li>
                <li><a class="nav-link" href="/usuario/logout">Logout</a></li>

<?php }else{ ?> 

                <li><a class="nav-link" href="/usuario/login">Log In</a></li>

<?php } ?>
            </ul>
        </div>
    </nav>
    
    <?= $this->Flash->render() ?>
    <div class="clearfix">
        <?= $this->fetch('content') ?>
    </div>
</body>
<br>
<br>
<br>
<br>
<br>
<footer class="py-5 bg-dark bottom">
        <p class="m-0 text-center text-white">Copyright &copy; Pablo Pazos Domínguez, Alejandro González García, Pablo Lama Valencia, Salvador Pérez Salcedo</p>
        <!-- /.container -->
</footer>
</html>
