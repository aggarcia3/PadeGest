<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriaNivel $categoriaNivel
 */
?>
<?= $this->element('menu') ?>
<div class="categoriaNivel form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($categoriaNivel) ?>
    <fieldset>
        <legend><?= __('Add Categoria Nivel') ?></legend>
        <?php
            echo $this->Form->control('categoria');
            echo $this->Form->control('nivel');
            echo $this->Form->control('idCampeonato');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
