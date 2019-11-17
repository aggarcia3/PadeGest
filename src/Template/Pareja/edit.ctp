<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pareja $pareja
 */
?>
<?= $this->element('menu') ?>
<div class="pareja form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($pareja) ?>
    <fieldset>
        <legend><?= __('Edit Pareja') ?></legend>
        <?php
            echo $this->Form->control('idCapitan');
            echo $this->Form->control('idCompanero');
            echo $this->Form->control('idCategoriaNivel');
            echo $this->Form->control('idGrupo');
            echo $this->Form->control('enfrentamiento._ids', ['options' => $enfrentamiento]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
