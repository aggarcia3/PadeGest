<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pista $pista
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('pistas')));

?>
<div class="pista form content">
    <?= $this->Form->create($pista) ?>
    <fieldset>
        <h3 class="card-title text-center"><?= __('Editar {0}', __('pista')) ?></h3>
        <?=
            $this->Form->control('tipoSuelo', [
                'label' => __('Tipo de suelo'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge uno'),
                    'césped' => __('Césped'),
                    'moqueta' => __('Moqueta'),
                    'hormigón' => __('Hormigón'),
                    'cemento' => __('Cemento')
                ]
            ])
        ?>
        <?=
            $this->Form->control('tipoCerramiento', [
                'label' => __('Tipo de cerramiento'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge uno'),
                    'valla' => __('Valla'),
                    'pared' => __('Pared'),
                    'cristal' => __('Cristal')
                ]
            ])
        ?>
        <?=
            $this->Form->control('localizacion', [
                'label' => __('Localización'),
                'type' => 'select',
                'options' => [
                    '' => __('Escoge una'),
                    'exterior' => __('Exterior'),
                    'interior' => __('Interior')
                ]
            ])
        ?>
        <?=
            $this->Form->control('focos', [
                'label' => __('Número de focos'),
                'min' => '0',
                'max' => '100'
            ])
        ?>
    </fieldset>
    <?= $this->Form->button(__('Editar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
