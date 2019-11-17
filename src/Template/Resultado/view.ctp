<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado $resultado
 */
?>
<?= $this->element('menu') ?>
<div class="resultado view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3><?= h($resultado->idEnfrentamiento) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('IdEnfrentamiento') ?></th>
            <td><?= $this->Number->format($resultado->idEnfrentamiento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set1pareja1') ?></th>
            <td><?= $this->Number->format($resultado->set1pareja1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set1pareja2') ?></th>
            <td><?= $this->Number->format($resultado->set1pareja2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set2pareja1') ?></th>
            <td><?= $this->Number->format($resultado->set2pareja1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set2pareja2') ?></th>
            <td><?= $this->Number->format($resultado->set2pareja2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set3pareja1') ?></th>
            <td><?= $this->Number->format($resultado->set3pareja1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Set3pareja2') ?></th>
            <td><?= $this->Number->format($resultado->set3pareja2) ?></td>
        </tr>
    </table>
</div>
