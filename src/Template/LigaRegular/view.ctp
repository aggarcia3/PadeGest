<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LigaRegular $ligaRegular
 */
?>
<?= $this->element('menu') ?>   

<div class="ligaRegular view large-9 medium-8 columns content">
    <h3><?= h($ligaRegular->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ligaRegular->id) ?></td>
        </tr>
    </table>
</div>
