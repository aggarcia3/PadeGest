<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Controller\Component\AuthComponent $Auth
 * @var \App\Model\Entity\Clase[]|\Cake\Collection\CollectionInterface $clase
 */

use App\Model\Table\ClaseTable;
use Cake\I18n\FrozenTime;
use Cake\Routing\Router;

// Page title
$this->assign('title', __('Gestión de {0}', __('clases')));

$esAdministrador = $Auth->user('rol') === 'administrador' || $Auth->user('rol') === 'entrenador';
$ahora = FrozenTime::now();

/**
 * Comprueba si un usuario con un determinado ID figura en la lista de usuarios inscritos en una clase.
 *
 * @param array $listaInscritos La lista de usuarios inscritos a comprobar.
 * @param int $idUsuario El identificador del usuario a comprobar.
 * @return bool Verdadero si el usuario está entre los inscritos, falso en otro caso.
 */
function enListaInscritos($listaInscritos, $idUsuario) {
    $toret = false;

    $i = 0;
    $n = count($listaInscritos);

    while (!$toret && $i < $n) {
        $toret = $listaInscritos[$i++]->id == $idUsuario;
    }

    return $toret;
}

?>
<div class="clase index content">
    <h3 class="card-title text-center">
        <?= __($esAdministrador ? 'Clases en el sistema' : 'Clases disponibles') ?>
        <?php if ($Auth->user('rol') === 'administrador'): ?>
        <a href="<?= Router::url(['controller' => 'Clase', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-right">
            <i class="fas fa-plus-square"></i>
        </a>
        <?php endif; ?>
    </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre', __('Contenidos')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('plazasMin', __('Aforo mínimo')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('plazasMax', __('Aforo máximo')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('frecuencia', __('Periodicidad')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaInicioInscripcion', __('Inicio de inscripciones')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('fechaFinInscripcion', __('Fin de inscripciones')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('semanasDuracion', __('Duración')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('horaInicio', __('Hora de inicio')) ?></th>
                <th scope="col" class="actions"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clase as $claseAct): ?>
            <?php $inscripcionPermitida = ClaseTable::admiteInscripciones($claseAct); ?>
            <?php if (($inscripcionPermitida && !enListaInscritos($claseAct->usuario, $Auth->user('id'))) || $esAdministrador): ?>
            <?php if ($esAdministrador && $inscripcionPermitida): ?>
            <tr class="clase-disponible">
            <?php elseif ($esAdministrador && !$inscripcionPermitida): ?>
            <tr class="clase-ocupada">
            <?php else: ?>
            <tr>
            <?php endif; ?>
                <td><?= h($claseAct->nombre) ?></td>
                <td><?= $this->Number->format($claseAct->plazasMin) ?></td>
                <td><?= $this->Number->format($claseAct->plazasMax) ?></td>
                <td><?= __('Una cada ') ?><?= $claseAct->frecuenciaSemanas > 1 ? $claseAct->frecuenciaSemanas : ' ' ?><?= __('{0,plural,=0{semanas}=1{semana} other{semanas}}', [$claseAct->frecuenciaSemanas]) ?></td>
                <td><?= h($claseAct->fechaInicioInscripcion) ?></td>
                <td><?= h($claseAct->fechaFinInscripcion) ?></td>
                <td><?= $this->Number->format($claseAct->semanasDuracion) ?> <?= __('{0,plural,=0{semanas}=1{semana} other{semanas}}', [$claseAct->semanasDuracion]) ?></td>
                <td><?= $this->Time->format($claseAct->horaInicio, 'HH:mm') ?></td>
                <td class="actions">
                    <?php if ($esAdministrador): ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['action' => 'view', $claseAct->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['action' => 'delete', $claseAct->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar la clase {0}? Esto borrará toda su información asociada.', [$claseAct->nombre])
                            ]
                        )
                    ?>
                    <?php elseif ($inscripcionPermitida): ?>
                    <?=
                        $this->Html->link(
                            '<i class="fas fa-user-check add-action-fa-icon"></i>',
                            ['action' => 'inscribirse', $claseAct->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Viendo {{current}} de {{count}} ') . __('{0,plural,=0{clases}=1{clase} other{clases}}', [count($clase)])]) ?></p>
    </div>
</div>
