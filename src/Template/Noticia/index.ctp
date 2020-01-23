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
        
        
            <?php foreach ($noticias as $noticium):
                if($noticium['id'] != ""): ?>

        <thead>
            <tr>
             <td colspan="11"><h5><?=  h($noticium->titulo) ?>, <?= h($noticium->fecha) ?></h5> </td>
             <?php if($Auth->user('rol') == "administrador"){ ?>
                <td class="actions">

                <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>', ['action' => 'view', $noticium->id], ['escapeTitle' => false]) ?>
                <?= $this->Html->link('<i class="fas fa-pen-square edit-action-fa-icon"></i>', ['action' => 'edit', $noticium->id], ['escapeTitle' => false]) ?>
                <?= $this->Form->postLink('<i class="fas fa-minus-square delete-action-fa-icon"></i>', ['action' => 'delete', $noticium->id], ['escapeTitle' => false, 'confirm' => __('¿Quieres eliminar la Noticia "{0}"?', $noticium->titulo)]) ?> 

                </td>

            <?php }else{ ?>
             <td class="actions" colspan="1">

                <?= $this->Html->link('<i class="fas fa-eye view-action-fa-icon"></i>', ['action' => 'view', $noticium->id], ['escapeTitle' => false]) ?>
            
            </td>

            <?php } ?>

            </tr>
        </thead>
        <tbody>
            <tr>
            
    
    <td colspan="12"><p class="text-justify text-wrap" ><?= h($noticium->cuerpo) ?></p></td>
    
    

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
