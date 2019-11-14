<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>
<?= $this->element('menu') ?>
<div class="campeonato view large-9 medium-8 columns content">
    <h3 class="card-title text-center" style="color: black;">Editar Campeonato: <?= h($campeonato->nombre) ?> </h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($campeonato->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($campeonato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaInicioInscripciones') ?></th>
            <td><?= h($campeonato->fechaInicioInscripciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaFinInscripciones') ?></th>
            <td><?= h($campeonato->fechaFinInscripciones) ?></td>
        </tr>
    </table>
        <h5 class="card-title" style="color: black;">Bases</h5>
        <?= $this->Text->autoParagraph(h($campeonato->bases)); ?>
</div>
