<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriaNivel $categoriaNivel
 */
?>

<div class="categoriaNivel view content">
    <h3 class="card-title text-center" style="color: black;">Nivel y Categoría: <?= h($categoriaNivel->nivel) ?> <?= h($categoriaNivel->categoria) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id de la categoría mas nivel') ?></th>
            <td><?= $this->Number->format($categoriaNivel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id del campeonato asociado') ?></th>
            <td><?= $this->Number->format($categoriaNivel->campeonato_id) ?></td>
        </tr>
    </table>


    <div class="related">
    <h3 class="card-title text-center" style="color: black;">Grupos de la categoría</h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id del grupo') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($resultsIteratorObject3 as $grupo): ?>
            <tr>
                <td><?= h($grupo->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['controller' => 'Grupo', 'action' => 'LigaRegular', $grupo->id], ['escapeTitle' => false]) ?>  
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
