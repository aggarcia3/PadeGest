<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Noticium[]|\Cake\Collection\CollectionInterface $noticium
 */

use Cake\Routing\Router;

?>
<div class="noticia index content">

<?php if($Auth->user('rol') == "administrador"){ ?>

    <h3 class="card-title text-center">Noticias<a href="<?= Router::url(['controller' => 'Noticia', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-right">Añadir noticia</a></h3>

<?php }else{ ?>

    <h3 class="card-title text-center">Noticias</h3>

<?php }?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
<?php if($Auth->user('rol') == "administrador"){ ?>

                <th scope="col"><?= $this->Paginator->sort('id', 'Id de la Noticia') ?></th>
<?php } ?>

                <th scope="col"><?= $this->Paginator->sort('titulo', 'Título') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cuerpo', 'Cuerpo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha', 'Fecha de publicación') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($noticias as $noticium):
                if($noticium['id'] != ""): ?>
            <tr>
<?php if($Auth->user('rol') == "administrador"){ ?>

    <td><?= $this->Number->format($noticium->id) ?></td>

<?php } ?>

    <td><?= h($noticium->titulo) ?></td>
    <td><?= h($noticium->cuerpo) ?></td>
    <td><?= h($noticium->fecha) ?></td>
    <td class="actions">

    <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>', ['action' => 'view', $noticium->id], ['escapeTitle' => false]) ?>
    <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['action' => 'edit', $noticium->id], ['escapeTitle' => false]) ?>
    <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['action' => 'delete', $noticium->id], ['escapeTitle' => false, 'confirm' => __('¿Quieres eliminar la Noticia "{0}"?', $noticium->id)]) ?>

            </tr>
                <?php endif; ?>
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
