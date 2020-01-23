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
            echo $this->Form->control('Número de Tarjeta', ['required' => true, 'type' => 'number'], array('maxlength'=>'19'));
            echo $this->Form->control('CVV / CVC', ['type' => 'number', 'required' => true], array('maxlength'=>'3'));
            echo $this->Form->input('Fecha de caducidad', array('type' => 'date', 'minYear' => date('Y'), 'maxYear' => date('Y') + 10,
      'year' => [
        'style'=>'width:60px'
      ],
      'day'=>null,

      'month' => [
        'style'=>'width:100px'
      ],'monthNames' => array( '01' => 'Enero', '02' => 'Febrero', 
                                                                                '03' => 'Marzo', '04' => 'Abril',
                                                                                '05' => 'Mayo', '06' => 'Junio',
                                                                                '07' => 'Julio', '08' => 'Agosto',
                                                                                '09' => 'Septiembre', '10' => 'Octubre',
                                                                                '11' => 'Noviembre', '12' => 'Diciembre')));?>
        
            <h5>La cuota de socio es 40€/mes</h5>
            <p>Se le cobrará la cuota en los primeros 5 días de cada mes</p>
    </fieldset>
    <?= $this->Form->button(__('Confirmar Pago')) ?>
    <?= $this->Form->end() ?>
</div>
