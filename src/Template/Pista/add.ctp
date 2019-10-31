<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pista $pista
 */

// Page title
$this->assign('title', __('Gestión de pistas'));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i> ' . __('Ver {0}', __('{0,plural,=0{pistas}=1{pista} other{pistas}}', [0])), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="pista form large-9 medium-8 columns content">
    <?= $this->Form->create($pista) ?>
    <fieldset>
        <legend><?= __('Crear {0}', __('pista')) ?></legend>
        <?php
            echo $this->Form->control('tipoSuelo', [
                'label' => __('Tipo de suelo'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge uno'),
                    'césped' => __('Césped'),
                    'moqueta' => __('Moqueta'),
                    'hormigón' => __('Hormigón'),
                    'cemento' => __('Cemento')
                ]
            ]);
            echo $this->Form->control('tipoCerramiento', [
                'label' => __('Tipo de cerramiento'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge uno'),
                    'valla' => __('Valla'),
                    'pared' => __('Pared'),
                    'cristal' => __('Cristal')
                ]
            ]);
            echo $this->Form->control('localizacion', [
                'label' => __('Localización'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge una'),
                    'exterior' => __('Exterior'),
                    'interior' => __('Interior')
                ]
            ]);
            echo $this->Form->control('focos', [
                'label' => __('Número de focos'),
                'min' => '0',
                'max' => '100'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Crear')) ?>
    <?= $this->Form->end() ?>
</div>
