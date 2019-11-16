<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
use Cake\I18n\Time;
Time::setDefaultLocale('es-ES');
Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
?>
<?= $this->element('menu') ?>
<div class="partidoPromocionado view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
<h3 class="card-title text-center" style="color: black;">Campeonato: <?= h($campeonato->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($campeonato->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha final de Inscripcion') ?></th>
            <td><?= h($campeonato->fechaFinInscripciones)?></td>
        </tr>
    </table>

    <?= $this->Form->create(false, array(
    'url' => array('controller' => 'pareja', 'action' => 'add'))) ?>
        <fieldset>

<?php

            echo $this->Form->control('usernameCapitan'); 
            echo $this->Form->control('usernamePareja'); 
            echo $this->Form->label('Categoria');
            echo $this->Form->select('categoria', [
                'masculina' => 'Masculina',
                'femenina' => 'Femenina',
                'mixta' => 'Mixta'
            ]);
            echo $this->Form->label('nivel');
            echo $this->Form->select('nivel', [
                '1' => '1 nivel',
                '2' => '2 nivel',
                '3' => '3 nivel'
            ]);
            echo $this->Form->input('campeonatoId', ['type' => 'hidden', 'default'=>$campeonato->id]);

?>

        </fieldset>
        <br>
    <?= $this->Form->button(__('Inscribirse'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
