<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Noticium $noticium
 */
?>

<div class="noticia view large-9 medium-8 columns content">
    <h3 class="card-title text-center">Editar Noticia: <?= h($noticium->id) ?> </h3>

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id de la Noticia') ?></th>
            <td><?= $this->Number->format($noticium->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Título') ?></th>
            <td><?= h($noticium->titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cuerpo') ?></th>
            <td><?= h($noticium->cuerpo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($noticium->fecha) ?></td>
        </tr>
    </table>

</div>
