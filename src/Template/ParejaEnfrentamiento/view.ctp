<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParejaEnfrentamiento $parejaEnfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('parejaEnfrentamiento')));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-pen-square edit-action-fa-icon"></i> ' . __('Editar {0}', __('Pareja Enfrentamiento')),
                ['action' => 'edit', $parejaEnfrentamiento->idEnfrentamiento],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fas fa-minus-square delete-action-fa-icon"></i> ' . __('Eliminar {0}', __('Pareja Enfrentamiento')),
                ['action' => 'delete', $parejaEnfrentamiento->idEnfrentamiento],
                ['escapeTitle' => false, 'confirm' =>
                    __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la Pareja Enfrentamiento número {0}', $parejaEnfrentamiento->idEnfrentamiento)])
                ]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('Pareja Enfrentamiento')),
                ['action' => 'index'],
                ['escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(
                '<i class="fas fa-plus-circle add-action-fa-icon"></i> ' . __('Crear {0}', __('Pareja Enfrentamiento')),
                ['action' => 'add'],
                ['escapeTitle' => false]
            )
        ?></li>
    </ul>
</nav>
<div class="parejaEnfrentamiento view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('parejaEnfrentamiento')) . ' ' . h($parejaEnfrentamiento->idEnfrentamiento) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Pareja Id') ?></th>
            <td><?= $this->Number->format($parejaEnfrentamiento->pareja_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enfrentamiento Id') ?></th>
            <td><?= $this->Number->format($parejaEnfrentamiento->enfrentamiento_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ParticipacionConfirmada') ?></th>
            <td><?= $this->Number->format($parejaEnfrentamiento->participacionConfirmada) ?></td>
        </tr>
    </table>
</div>
