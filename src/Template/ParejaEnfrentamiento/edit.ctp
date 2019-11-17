<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ParejaEnfrentamiento $parejaEnfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('parejaEnfrentamiento')));
?>
<?= $this->element('menu') ?>
<div class="parejaEnfrentamiento form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($parejaEnfrentamiento) ?>
    <fieldset>
        <legend><?= __('Edit Pareja Enfrentamiento') ?></legend>
        <?php
            echo $this->Form->control('pareja_id');
            echo $this->Form->control('enfrentamiento_id');
            echo $this->Form->control('participacionConfirmada');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
