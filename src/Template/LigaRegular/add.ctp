<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LigaRegular $ligaRegular
 */
?>
<?= $this->element('menu') ?> 
<div class="ligaRegular form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add Liga Regular') ?></legend>
        <?php
                echo $this->Form->control('id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
