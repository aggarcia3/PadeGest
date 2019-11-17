<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */

?>
<div class="partidoPromocionado view content">
<h3 class="card-title text-center">Partido Promocionado: <?= h($partidoPromocionado->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($partidoPromocionado->nombre) ?></td>
        </tr>
        <tr>

            <th scope="row"><?= __('Fecha del partido') ?></th>
            <td><?= h($partidoPromocionado->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha final de Inscripcion') ?></th>
            <td><?= h($partidoPromocionado->fecha->subDays(2))?></td>
        </tr>
    </table>

    <?= $this->Form->create(false, array(
    'url' => array('controller' => 'usuarioPartidoPromocionado', 'action' => 'add'))) ?>
        <fieldset>
            <?= $this->Form->input('partido_promocionado_id', ['type' => 'hidden', 'default'=>$partidoPromocionado->id])?>
        </fieldset>
    <?= $this->Form->button(__('Inscribirse'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
</div>
