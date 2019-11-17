<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado $resultado
 */
?>
<?= $this->element('menu') ?>
<div class="resultado form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($resultado) ?>
    <fieldset>
        <legend><?= __('Add Resultado') ?></legend>
        <?php
            echo $this->Form->control('set1pareja1');
            echo $this->Form->control('set1pareja2');
            echo $this->Form->control('set2pareja1');
            echo $this->Form->control('set2pareja2');
            echo $this->Form->control('set3pareja1');
            echo $this->Form->control('set3pareja2');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
