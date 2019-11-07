<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PartidoPromocionado $partidoPromocionado
 */
use Cake\I18n\Time;
Time::setDefaultLocale('es-ES');
Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Partido Promocionado'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="partidoPromocionado view large-9 medium-8 columns content">
    <h3><?= h($partidoPromocionado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= $this->Number->format($partidoPromocionado->nombre) ?></td>
        </tr>
        <tr>

<?php
            $fechaInscribirse =  new Time($partidoPromocionado->fecha);
            $fechaInscribirse->subDays(2);
?>

            <th scope="row"><?= __('Fecha del partido') ?></th>
            <td><?= h(new Time($partidoPromocionado->fecha)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha final de Inscripcion') ?></th>
            <td><?= h($fechaInscribirse) ?></td>
        </tr>
    </table>

    <?= $this->Form->create(false, array(
    'url' => array('controller' => 'usuarioPartidoPromocionado', 'action' => 'add'))) ?>
        <fieldset>
            <legend><?= __('Inscribirse') ?>
            <?= $this->Form->input('partido_promocionado_id', ['type' => 'hidden', 'default'=>$partidoPromocionado->id])?>
        </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
