<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParejaEnfrentamiento[]|\Cake\Collection\CollectionInterface $parejaEnfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('parejaEnfrentamiento')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Pareja Enfrentamiento')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="parejaEnfrentamiento index large-9 medium-8 columns content">
    <h3><?= __('Pareja Enfrentamiento') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('pareja_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('enfrentamiento_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('participacionConfirmada') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parejaEnfrentamiento as $parejaEnfrentamiento): ?>
            <tr>
                <td><?= $this->Number->format($parejaEnfrentamiento->pareja_id) ?></td>
                <td><?= $this->Number->format($parejaEnfrentamiento->enfrentamiento_id) ?></td>
                <td><?= $this->Number->format($parejaEnfrentamiento->participacionConfirmada) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['action' => 'view', $parejaEnfrentamiento->idEnfrentamiento],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['action' => 'edit', $parejaEnfrentamiento->idEnfrentamiento],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['action' => 'delete', $parejaEnfrentamiento->idEnfrentamiento],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la parejaEnfrentamiento número {0}', $parejaEnfrentamiento->idEnfrentamiento)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{$parejaEnfrentamiento}=1{$parejaEnfrentamiento} other{$parejaEnfrentamiento}}', [count($parejaEnfrentamiento)])]) ?></p>
    </div>
</div>
