  
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enfrentamiento $enfrentamiento
 */
// Page title
use Cake\ORM\TableRegistry;
$this->assign('title', __('Gestión de {0}', __('enfrentamiento')));
?>
<div class="enfrentamiento view content">
    <h3 class="card-title text-center" style="color: black;"><?= __('Detalles del {0}', __('enfrentamiento')) . ' ' . h($enfrentamiento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($enfrentamiento->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reserva') ?></th>
            <td><?= $enfrentamiento->has('reserva') ? $this->Html->link($enfrentamiento->reserva->id, ['controller' => 'Reserva', 'action' => 'view', $enfrentamiento->reserva->id]) : 'No hay Reserva' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($enfrentamiento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($enfrentamiento->fecha) ?></td>
        </tr>
    </table>
    <div class="related">
        <h3 class="card-title text-center" style="color: black;"><?= __('Parejas Enfrentadas') ?></h3>
        <?php if (!empty($enfrentamiento->pareja)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('IdCapitan') ?></th>
                <th scope="col"><?= __('IdCompanero') ?></th>
                <th scope="col"><?= __('Categoria Nivel Id') ?></th>
                <th scope="col"><?= __('Grupo Id') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($enfrentamiento->pareja as $pareja): 
            $usuario = TableRegistry::getTableLocator()->get('Usuario');
            $usuarioFiltrado = $usuario->find()->where(['id' => $pareja['idCapitan']])->all();
            $usuario2 = TableRegistry::getTableLocator()->get('Usuario');
            $usuarioFiltrado2 = $usuario2->find()->where(['id' => $pareja['idCompanero']])->all();
            ?>
            <tr>
                <td><?= h($pareja->id) ?></td>
                <?php foreach ($usuarioFiltrado as $usuario): ?>
                <td><?= h($usuario->username) ?></td>
                <?php endforeach; ?>
                <?php foreach ($usuarioFiltrado2 as $usuario): ?>
                <td><?= h($usuario->username) ?></td>
                <?php endforeach; ?>
                <td><?= h($pareja->categoria_nivel_id) ?></td>
                <td><?= h($pareja->grupo_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Pareja', 'action' => 'view', $pareja->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'Pareja', 'action' => 'edit', $pareja->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'Pareja', 'action' => 'delete', $pareja->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la pareja número {0}', $pareja->id)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h3 class="card-title text-center" style="color: black;"><?= __('Resultado del enfrentamiento') ?></h3>
        <?php if (!empty($enfrentamiento->resultado)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"></th>
                <th scope="col">Set 1</th>
                <th scope="col">Set 2</th>
                <th scope="col">Set 3</th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($resultado as $resultado): ?>
            <tr>
                <td>Pareja1</td>
                <td><?= h($resultado->set1pareja1) ?></td>
                <td><?= h($resultado->set2pareja1) ?></td>
                <td><?= h($resultado->set3pareja1) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'view', $resultado->enfrentamiento_id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'edit', $resultado->enfrentamiento_id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'delete', $resultado->enfrentamiento_id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la resultado número {0}', $resultado->idEnfrentamiento)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <tr>
                <td>Pareja2</td>
                <td><?= h($resultado->set1pareja2) ?></td>
                <td><?= h($resultado->set2pareja2) ?></td>
                <td><?= h($resultado->set3pareja2) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'view', $resultado->enfrentamiento_id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'edit', $resultado->enfrentamiento_id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'Resultado', 'action' => 'delete', $resultado->enfrentamiento_id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la resultado número {0}', $resultado->idEnfrentamiento)])
                            ]
                        )
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        <?php if (empty($enfrentamiento->resultado)):
            $idEnfrentamiento = $enfrentamiento->id ?>
            <?= $this->Html->link(('Añadir Resultado'), array('controller' => 'Resultado', 'action' => 'add', $idEnfrentamiento), array('class' => 'btn btn-primary center text-center')) ?>
        <?php endif; ?>
    </div>
</div>