<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resultado $resultado
 */
?>
<div class="resultado view content">
<h3 class="card-title text-center" style="color: black;"><?= __('Resultado del {0}', __('enfrentamiento')) . ' ' . h($resultado->enfrentamiento_id) ?></h3>
    <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"></th>
                <th scope="col">Set 1</th>
                <th scope="col">Set 2</th>
                <th scope="col">Set 3</th>
            </tr>
            <tr>
                <td>Pareja1</td>
                <td><?= h($resultado->set1pareja1) ?></td>
                <td><?= h($resultado->set2pareja1) ?></td>
                <td><?= h($resultado->set3pareja1) ?></td>
            </tr>
            <tr>
                <td>Pareja2</td>
                <td><?= h($resultado->set1pareja2) ?></td>
                <td><?= h($resultado->set2pareja2) ?></td>
                <td><?= h($resultado->set3pareja2) ?></td>
            </tr>
    </table>
</div>
