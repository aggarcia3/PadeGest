<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
// Page title
?>
<div class="grupo view large-9 medium-8 columns content">
    <h3><?= __('Detalles de la {0}', __('grupo')) . ' ' . h($grupo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grupo->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Pareja relacionadas') ?></h4>
        <?php if (!empty($resultsIteratorObject3)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('IdCapitan') ?></th>
                <th scope="col"><?= __('IdCompanero') ?></th>
                <th scope="col"><?= __('Categoria Nivel Id') ?></th>
                <th scope="col"><?= __('Grupo Id') ?></th>
                <th scope="col"><?= __('Puntuacion') ?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <?php foreach ($resultsIteratorObject3 as $pareja): ?>
            <tr>
                <td><?= h($pareja->id) ?></td>
                <td><?= h($pareja->idCapitan) ?></td>
                <td><?= h($pareja->idCompanero) ?></td>
                <td><?= h($pareja->categoria_nivel_id) ?></td>
                <td><?= h($pareja->grupo_id) ?></td>
                <td><?= h($pareja->puntuacion)?></td>
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

        <?php if (!empty($iterador)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Reserva_id') ?></th>
                <th scope="col"><?= __('fase') ?></th>
                <th scope="col"><?=__('nombrecapitan')?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <tr><h4><?= __('Enfrentamientos Cuartos') ?></h4></tr>
            <?php foreach ($iterador as $enfrentamiento): ?>
            <tr>
            <?php if ($enfrentamiento->fase == "playoffs4"): ?>
                <td><?= h($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->nombre) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?= h($enfrentamiento->reserva_id) ?></td>
                <td><?= h($enfrentamiento->fase) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'view', $enfrentamiento->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'edit', $enfrentamiento->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'delete', $enfrentamiento->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la pareja número {0}', $pareja->id)])
                            ]
                        )
                    ?>
                </td>
                <?php endif; ?>
            </tr>

            <?php endforeach; ?>
                        
        </table>

        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Reserva_id') ?></th>
                <th scope="col"><?= __('fase') ?></th>
                <th scope="col"><?=__('nombrecapitan')?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <tr><h4><?= __('Enfrentamientos Semis') ?></h4></tr>
            <?php foreach ($iterador as $enfrentamiento): ?>
            <tr>
            <?php if ($enfrentamiento->fase == "playoffs2"): ?>
                <td><?= h($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->nombre) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?= h($enfrentamiento->reserva_id) ?></td>
                <td><?= h($enfrentamiento->fase) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'view', $enfrentamiento->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'edit', $enfrentamiento->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'delete', $enfrentamiento->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la pareja número {0}', $pareja->id)])
                            ]
                        )
                    ?>
                </td>
                <?php endif; ?>
            </tr>

            <?php endforeach; ?>
                        
        </table>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Reserva_id') ?></th>
                <th scope="col"><?= __('fase') ?></th>
                <th scope="col"><?=__('nombrecapitan')?></th>
                <th scope="col" class="actions"></th>
            </tr>
            <tr><h4><?= __('La Gran final') ?></h4></tr>
            <?php foreach ($iterador as $enfrentamiento): ?>
            <tr>
            <?php if ($enfrentamiento->fase == "playoffs1"): ?>
                <td><?= h($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->nombre) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?= h($enfrentamiento->reserva_id) ?></td>
                <td><?= h($enfrentamiento->fase) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                            '<i class="fas fa-eye view-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'view', $enfrentamiento->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Html->link(
                            '<i class="fas fa-pen-square edit-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'edit', $enfrentamiento->id],
                            ['escapeTitle' => false]
                        )
                    ?>
                    <?= $this->Form->postLink(
                            '<i class="fas fa-minus-square delete-action-fa-icon"></i>',
                            ['controller' => 'enfrentamiento', 'action' => 'delete', $enfrentamiento->id],
                            ['escapeTitle' => false, 'confirm' =>
                                __('¿Estás seguro de que quieres eliminar {0}? Esto borrará toda su información asociada.', [__('la pareja número {0}', $pareja->id)])
                            ]
                        )
                    ?>
                </td>
                <?php endif; ?>
            </tr>

            <?php endforeach; ?>
                        
        </table>
        <?php endif; ?>
    </div>
    <?= $this->Html->link('Generar Playoffs', array('class' => 'btn btn-primary','controller'=>'Grupo','action'=>'generarPlayoffs',$grupo->id),['escapeTitle'=>false]);?>
</div>