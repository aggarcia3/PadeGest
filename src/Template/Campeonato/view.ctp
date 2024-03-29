<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>

<div class="campeonato view content">
    <h3 class="card-title text-center"> Campeonato: <?= h($campeonato->nombre) ?> </h3>

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id del Campeonato') ?></th>
            <td><?= $this->Number->format($campeonato->id) ?></td>
        </tr>
        <tr> 
            <th scope="row"><?= __('Nombre del Campeonato') ?></th>
            <td><?= h($campeonato->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Inicio Inscripciones') ?></th>
            <td><?= h($campeonato->fechaInicioInscripciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Fin Inscripciones') ?></th>
            <td><?= h($campeonato->fechaFinInscripciones) ?></td>
        </tr>
    </table>
        <h5 class="card-title">Bases</h5>
        <?= $this->Text->autoParagraph(h($campeonato->bases)); ?>


<div class="related">
    <h3 class="card-title text-center">Categorias del campeonato</h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Categoria') ?></th>
                <th scope="col"><?= __('Nivel') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($resultsIteratorObject as $CategoriaNivel): ?>
            <tr>
                <td><?= h($CategoriaNivel->id) ?></td>
                <td><?= h($CategoriaNivel->categoria) ?></td>
                <td><?= h($CategoriaNivel->nivel) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['controller' => 'CategoriaNivel', 'action' => 'view', $CategoriaNivel->id], ['escapeTitle' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    </div>
