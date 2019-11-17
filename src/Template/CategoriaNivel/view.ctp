<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriaNivel $categoriaNivel
 */
?>
<?= $this->element('menu') ?>
<div class="categoriaNivel view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= h($categoriaNivel->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= h($categoriaNivel->categoria) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nivel') ?></th>
            <td><?= h($categoriaNivel->nivel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($categoriaNivel->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('campeonato_id') ?></th>
            <td><?= $this->Number->format($categoriaNivel->campeonato_id) ?></td>
        </tr>
    </table>


    <div class="related">
    <h3 class="card-title text-center" style="color: black;">Grupos de la categoría</h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($resultsIteratorObject3 as $grupo): ?>
            <tr>
                <td><?= h($grupo->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>' , ['controller' => 'Grupo', 'action' => 'view', $grupo->id], ['escapeTitle' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
