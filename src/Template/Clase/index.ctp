<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clase[]|\Cake\Collection\CollectionInterface $clase
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('clase')));
?>
<div class="clase index large-9 medium-8 columns content">
    <h3><?= __('Clase') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plazasMin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plazasMax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('frecuencia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaInicioInscripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaFinInscripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('semanasDuracion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('horaInicio') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clase as $clase): ?>
            <tr>
                <td><?= $this->Number->format($clase->id) ?></td>
                <td><?= h($clase->nombre) ?></td>
                <td><?= $this->Number->format($clase->plazasMin) ?></td>
                <td><?= $this->Number->format($clase->plazasMax) ?></td>
                <td><?= h($clase->frecuencia) ?></td>
                <td><?= h($clase->fechaInicioInscripcion) ?></td>
                <td><?= h($clase->fechaFinInscripcion) ?></td>
                <td><?= $this->Number->format($clase->semanasDuracion) ?></td>
                <td><?= h($clase->horaInicio) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['action' => 'view', $clase->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['action' => 'edit', $clase->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['action' => 'delete', $clase->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la clase número {0}', $clase->id)])
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
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{$clase}=1{$clase} other{$clase}}', [count($clase)])]) ?></p>
    </div>
</div>
