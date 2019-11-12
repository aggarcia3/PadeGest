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

?>
<?= $this->Html->docType() ?>
<html lang='es-ES'>
<head>
    <?= $this->Html->charset() ?>
    <?= '<noscript>' . $this->fetch('noscript') . '</noscript>' ?>
    <?= $this->Html->meta('viewport', 'width=device-width, initial-scale=1.0') ?>
    <title>
        PadeGest:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base') ?>
    <?= $this->Html->css('style') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><?= $this->Html->link('PadeGest', ['controller' => 'Usuario', 'action' => 'index']) ?></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if ($Auth->user() !== null): ?>
                <li><?=
                    $this->Html->link('<i class="fas fa-user"></i> ' . $Auth->user('username'), [
                        'controller' => 'Usuario',
                        'action' => 'view', $Auth->user('id')
                    ], ['escapeTitle' => false])
                ?></li>
                <li><?=
                    $this->Html->link('<i class="fas fa-sign-out-alt"></i>', [
                        'controller' => 'Usuario',
                        'action' => 'logout'
                    ], ['escapeTitle' => false])
                ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>

    <footer id="footer">
        <p>Aplicación desarollada por Alejandro González García, Pablo Lama Valencia, Pablo Pazos Domínguez y Salvador Pérez Salcedo</p>
    </footer>
</body>
</html>
