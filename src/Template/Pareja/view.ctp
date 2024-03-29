<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pareja $pareja
 */
?>
<div class="pareja view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= h($pareja->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pareja->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdCapitan') ?></th>
            <td><?= $this->Number->format($pareja->idCapitan) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdCompanero') ?></th>
            <td><?= $this->Number->format($pareja->idCompanero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdCategoriaNivel') ?></th>
            <td><?= $this->Number->format($pareja->idCategoriaNivel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdGrupo') ?></th>
            <td><?= $this->Number->format($pareja->idGrupo) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Enfrentamiento') ?></h4>
        <?php if (!empty($pareja->enfrentamiento)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('IdReserva') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pareja->enfrentamiento as $enfrentamiento): ?>
            <tr>
                <td><?= h($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?= h($enfrentamiento->idReserva) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Enfrentamiento', 'action' => 'view', $enfrentamiento->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Enfrentamiento', 'action' => 'edit', $enfrentamiento->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Enfrentamiento', 'action' => 'delete', $enfrentamiento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enfrentamiento->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
