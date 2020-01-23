<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pago $pago
 */

// Page title
$this->assign('title', __('Gestión de {0}', __('pago')));
?>
<div class="pago view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('pago')) . ' ' . h($pago->id) ?></h3>
    <table class="vertical-table">
    </table>
</div>
