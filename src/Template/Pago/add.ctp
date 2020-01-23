<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pago $pago
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('pago')));
?>

<div class="pago form content">
    <?= $this->Form->create($pago) ?>
    <fieldset>
    <h3 class="card-title text-center" style="color: black;">Hacerse Socio</h3>
        <?php
            echo $this->Form->control('esSocio',['type' => 'hidden'], array('default'=>$esSocio), );
            echo $this->Form->control('Número de Tarjeta', ['required' => true]);
            echo $this->Form->control('CVV / CVC', ['type' => 'number', 'required' => true]);
            echo $this->Form->control('Fecha Vencimiento Tarjeta', ['required' => true]);
        ?>
            <h5>La cuota de socio es 40€/mes</h5>
            <p>Se le cobrará la cuota en los primeros 5 días de cada mes</p>
    </fieldset>
    <?= $this->Form->button(__('Confirmar Pago')) ?>
    <?= $this->Form->end() ?>
</div>
