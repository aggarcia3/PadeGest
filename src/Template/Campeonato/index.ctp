<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Campeonato[]|\Cake\Collection\CollectionInterface $campeonato
 */

use Cake\Routing\Router;

?>
<?= $this->element('menu') ?>
<div class="campeonato index large-9 medium-8 columns content">

<?php if($Auth->user('rol') == "administrador"){ ?>

    <h3 class="card-title text-center">Campeonatos<a href="<?= Router::url(['controller' => 'Campeonato', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-right">Añadir campeonato</a></h3>

<?php }else{ ?>

    <h3 class="card-title text-center">Campeonatos</h3>

<?php }?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
<?php if($Auth->user('rol') == "administrador"){ ?>

                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>

                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaInicioInscripciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaFinInscripciones') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($campeonato as $campeonato): ?>
            <tr>
<?php if($Auth->user('rol') == "administrador"){ ?>

                <td><?= $this->Number->format($campeonato->id) ?></td>

<?php } ?>

                <td><?= h($campeonato->nombre) ?></td>
                <td><?= h($campeonato->fechaInicioInscripciones) ?></td>
                <td><?= h($campeonato->fechaFinInscripciones) ?></td>
                <td class="actions">

<?php if($Auth->user('rol') == "deportista"){ ?>

                <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i> Inscribirse', ['action' => 'inscribirse', $campeonato->id], ['escapeTitle' => false]) ?>

<?php } else { ?>

                <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>', ['action' => 'view', $campeonato->id], ['escapeTitle' => false]) ?>
                <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['action' => 'edit', $campeonato->id], ['escapeTitle' => false]) ?>
                <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['action' => 'delete', $campeonato->id], ['escapeTitle' => false, 'confirm' => __('¿Quieres eliminar el Campeonato "{0}"?', $campeonato->nombre)]) ?>

<?php }  ?>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
