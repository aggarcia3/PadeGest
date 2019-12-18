<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado $resultado
 */
?>
<div class="resultado form content">
    <?= $this->Form->create()?>
    <fieldset>
        <h3 class="card-title text-center" style="color: black;">Resultado para el Enfrentamiento</h3>
        <?php
            echo $this->Form->control('enfrentamientoId');
            echo $this->Form->control('set1pareja1');
            echo $this->Form->control('set1pareja2');
            echo $this->Form->control('set2pareja1');
            echo $this->Form->control('set2pareja2');
            echo $this->Form->control('set3pareja1');
            echo $this->Form->control('set3pareja2');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Introducir Resultado')) ?>
    <?= $this->Form->end() ?>
</div>
