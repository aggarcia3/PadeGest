<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LigaRegular $ligaRegular
 */
?>
<?= $this->element('menu') ?> 
<div class="ligaRegular form large-9 medium-8 columns content">
    <?= $this->Form->create($ligaRegular) ?>
    <fieldset>
        <legend><?= __('Edit Liga Regular') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
