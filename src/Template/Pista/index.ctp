<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pista[]|\Cake\Collection\CollectionInterface $pista
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('pistas')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('pista')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="pista index large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= __('Pistas del club') ?></h3>
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
