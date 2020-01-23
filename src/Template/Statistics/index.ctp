<?php

use Cake\Routing\Router;

// Page title
$this->assign('title', 'Estadísticas');

?>
<div class="statistics view content">

    <h3 class="card-title text-center">
       Estadísticas de reservas
    </h3>

    <table cellpadding="0" cellspacing="0">
            <tr>
                <th>Número de reservas totales</th>
                <th></th>
                <th><?= h($contadorReservas) ?></th>
            </tr>
        </tbody>
    </table>
<br>
    <h5 class="card-title text-center">
       Pista más reservada
    </h5>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fecha Inicio semana', __('Pista más reservada')) ?></th>
                <th></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Numero de reservas')) ?></th>
            </tr>
        </thead>
        <tbody>
                <td>Pista número <?= h($pistaFinal) ?></td>
                <td></td>
                <td><?= h($contadorPistaReservas) ?> reservas</td>
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
                <td><?= h($contadorHoraReservas) ?> reservas</td>
            </tr>
        </tbody>
    </table>

<br><br><br>
    <h3 class="card-title text-center">
        Estadísticas de pagos
    </h3>

    <h5 class="card-title text-center">
       Por mes
    </h5>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fecha Inicio semana', __('Fecha Inicio mes')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha Fin semana', __('Fecha Fin mes')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Numero de pagos')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Importe por mes')) ?></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $i = 0;
        $i2 = 1;
        
        foreach ($contadores2 as $contador): ?>
            <tr>
                <td><?= h($fechaInicioDefinitiva2->addMonth($i)) ?></td>
                <td><?= h($fechaInicioDefinitiva2->addMonth($i2)) ?></td>
                <td><?= h($contador) ?> pagos</td>
                <td><?= h($importePorMes[$i]) ?> €</td>
            </tr>

            <?php 
        $i++;
        $i2++;
        endforeach; ?> 
            <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td></td>
            </tr>
            <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            </tr>
            <tr>
                <th>Importe total</th>
                <th></th>
                <th></th>
                <th><?= h($importeTotal) ?> €</th>
            </tr>
        </tbody>
    </table>

    <h3 class="card-title text-center">
        Estadísticas de escuelas deportivas
    </h3>

    <h5 class="card-title text-center">
       Clase más atendida
    </h5>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Fecha Inicio semana', __('Clase más atendida')) ?></th>
                <th></th>
                <th scope="col"><?= $this->Paginator->sort('Numero de reservas', __('Numero de reservas')) ?></th>
            </tr>
        </thead>
        <tbody>
                <td> <?= h($nombreClase) ?></td>
                <td></td>
                <td><?= h($contadorClaseVisitada) ?> reservas</td>
            </tr>
        </tbody>
    </table>
</div>
