<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato $campeonato
 */
?>
<div class="campeonato view large-9 medium-8 columns content">
    <h3 class="card-title text-center">Editar Campeonato: <?= h($campeonato->nombre) ?> </h3>
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
        <h5 class="card-title">Bases</h5>
        <?= $this->Text->autoParagraph(h($campeonato->bases)); ?>


<div class="related">
    <h3 class="card-title text-center">Categorias del campeonato</h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('categoria') ?></th>
                <th scope="col"><?= __('nivel') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
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
