<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Noticium $noticium
 */
?>

<div class="noticia view large-12 medium-12 columns content">
    <h3 class="card-title text-center"><?=  h($noticium->titulo) ?> </h3>

    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="12"><p style="font-size: 20px;"><?= h($noticium->cuerpo) ?></p></td>
            </tr>
        </tbody>
    </table>
</div>
