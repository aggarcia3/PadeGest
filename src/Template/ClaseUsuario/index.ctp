<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClaseUsuario[]|\Cake\Collection\CollectionInterface $claseUsuario
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('claseUsuario')));
?>
<div class="claseUsuario index large-9 medium-8 columns content">
    <h3><?= __('Clase Usuario') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('clase_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario_id') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($claseUsuario as $claseUsuario): ?>
            <tr>
                <td><?= $claseUsuario->has('clase') ? $this->Html->link($claseUsuario->clase->id, ['controller' => 'Clase', 'action' => 'view', $claseUsuario->clase->id]) : '' ?></td>
                <td><?= $claseUsuario->has('usuario') ? $this->Html->link($claseUsuario->usuario->id, ['controller' => 'Usuario', 'action' => 'view', $claseUsuario->usuario->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['action' => 'view', $claseUsuario->clase_id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['action' => 'edit', $claseUsuario->clase_id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['action' => 'delete', $claseUsuario->clase_id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la claseUsuario número {0}', $claseUsuario->clase_id)])
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
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{$claseUsuario}=1{$claseUsuario} other{$claseUsuario}}', [count($claseUsuario)])]) ?></p>
    </div>
</div>
