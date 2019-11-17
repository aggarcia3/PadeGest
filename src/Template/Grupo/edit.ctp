<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('grupo')));
?>
<?= $this->element('menu') ?>
<div class="grupo form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($grupo) ?>
    <fieldset>
        <legend><?= __('Edit Grupo') ?></legend>
        <?php
            echo $this->Form->control('categoria_nivel_id', ['options' => $categoriaNivel]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
