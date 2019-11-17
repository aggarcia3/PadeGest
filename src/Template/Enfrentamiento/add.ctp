<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enfrentamiento $enfrentamiento
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('enfrentamiento')));
?>
<?= $this->element('menu') ?>
<div class="enfrentamiento form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($enfrentamiento) ?>
    <fieldset>
        <legend><?= __('Add Enfrentamiento') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('fecha');
            echo $this->Form->control('fase');
            echo $this->Form->control('reserva_id', ['options' => $reserva, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
