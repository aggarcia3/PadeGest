<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pista[]|\Cake\Collection\CollectionInterface $pista
 */

use Cake\Routing\Router;

// Page title
$this->assign('title', __('Gestión de {0}', __('pistas')));
?>
<div class="pista index content">
    <h3 class="card-title text-center">
        <?= __('Pistas del club') ?>
        <a href="<?= Router::url(['controller' => 'Pista', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-right">
            <i class="fas fa-plus-circle"></i>
        </a>
    </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', __('Número de pista')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipoSuelo', __('Tipo de suelo')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipoCerramiento', __('Tipo de cerramiento')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('localizacion', __('Localización')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('focos', __('Número de focos')) ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pista as $pistaAct): ?>
            <tr>
                <td><?= $this->Number->format($pistaAct->id) ?></td>
                <td><?= ucfirst(h(__($pistaAct->tipoSuelo))) ?></td>
                <td><?= ucfirst(h(__($pistaAct->tipoCerramiento))) ?></td>
                <td><?= ucfirst(h(__($pistaAct->localizacion))) ?></td>
                <td><?= $this->Number->format($pistaAct->focos) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['action' => 'view', $pistaAct->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['action' => 'edit', $pistaAct->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['action' => 'delete', $pistaAct->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la pista número {0}', $pistaAct->id)])
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
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{pistas}=1{pista} other{pistas}}', [count($pista)])]) ?></p>
    </div>
</div>
