<?php

use Cake\Routing\Router;

// Page title
$this->assign('title', 'Estadísticas');

?>
<div class="statistics view content">

    <h3 class="card-title text-center">
       Estadísticas de reservas
    </h3>


    <h5 class="card-title text-center">
       Por semana
    </h5>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fecha Inicio semana', __('Fecha Inicio mes')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha Fin semana', __('Fecha Fin mes')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Numero de reservas')) ?></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $i = 1;
        
        foreach ($contadores as $contador): ?>
            <tr>
                <td><?= h($fechaInicioDefinitiva) ?></td>
                <td><?= h($fechaInicioDefinitiva->addMonth($i)) ?></td>
                <td><?= h($contador) ?></td>
            </tr>

            <?php 
        $i++;
        endforeach; ?> 
            <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            </tr>
            <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            </tr>
            <tr>
                <th>Número de reservas totales</th>
                <th></th>
                <th><?= h($contadorReservas) ?></th>
            </tr>
        </tbody>
    </table>

    <h5 class="card-title text-center">
       Pista más reservada
    </h5>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fecha Inicio semana', __('Id de la pista')) ?></th>
                <th></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Numero de reservas')) ?></th>
            </tr>
        </thead>
        <tbody>
                <td><?= h($pistaFinal) ?></td>
                <td></td>
                <td><?= h($contadorPistaReservas) ?></td>
            </tr>
        </tbody>
    </table>

    <h5 class="card-title text-center">
       Hora más reservada
    </h5>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fecha Inicio semana', __('Hora más reservada')) ?></th>
                <th></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Numero de reservas')) ?></th>
            </tr>
        </thead>
        <tbody>
                <td><?= h($horaFinal) ?></td>
                <td></td>
                <td><?= h($contadorHoraReservas) ?></td>
            </tr>
        </tbody>
    </table>


    <h3 class="card-title text-center">
        Estadísticas de pagos
    </h3>

    <h3 class="card-title text-center">
        Estadísticas de clases deportivas
    </h3>
</div>
