<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParejaEnfrentamiento $parejaEnfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('parejaEnfrentamiento')));
?>
<?= $this->element('menu') ?>
<div class="parejaEnfrentamiento view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
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
