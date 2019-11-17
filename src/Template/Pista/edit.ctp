<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pista $pista
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('pistas')));

?>
<?= $this->element('menu') ?>
<div class="pista form large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <?= $this->Form->create($pista) ?>
    <fieldset>
        <legend><?= __('Editar {0}', __('pista')) ?></legend>
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
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>
