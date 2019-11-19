<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
// Page title
use Cake\ORM\TableRegistry;
$categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
$CategoriaNivelFiltrado = $categoriaNivel->find()->where(['id' => $grupo->categoria_nivel_id])->all();
foreach($CategoriaNivelFiltrado as $iterador2){
    $nivel = $iterador2['nivel'];
    $categoria = $iterador2['categoria'];
}
?>
<?= $this->element('menu') ?>
<div class="grupo view large-9 medium-8 columns content" style="padding-bottom: 0px; margin-bottom:0px;">
    <h3 class="card-title text-center" style="color: black;"><?= __('Detalles del {0}', __('grupo')) . ' ' . h($grupo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= h($categoria) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nivel') ?></th>
            <td><?= h($nivel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grupo->id) ?></td>
        </tr>
    </table>
    <div class="related">
    <h3 class="card-title text-center" style="color: black;"><?= __('Parejas del Grupo ').h($grupo->id) ?></h3>
        <?php if (!empty($resultsIteratorObject3)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Capitan') ?></th>
                <th scope="col"><?= __('Compañero') ?></th>
                <th scope="col"><?= __('Categoria Nivel Id') ?></th>
                <th scope="col"><?= __('Grupo Id') ?></th>
                <th scope="col" class="actions">Acciones</th>
            </tr>
            <?php
            foreach ($resultsIteratorObject3 as $pareja): 
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
        <h3 class="card-title text-center" style="color: black;"><?= __('Enfrentamientos de Liga Regular Grupo ').h($grupo->id) ?></h3>
        <?php if (!empty($iterador)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Id de reserva de pista') ?></th>
                <th scope="col"><?= __('fase del campeonato') ?></th>
                <th scope="col" class="actions">Acciones</th>
            </tr>
            <?php foreach ($iterador as $enfrentamiento): 
                if($enfrentamiento['fase'] == "liga regular"):
            ?>
            <tr>
                <td><?= h($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->nombre) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?php echo (h($enfrentamiento->reserva_id) == "") ? "No hay reserva" :  h($enfrentamiento->reserva_id); ?></td>
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
            </tr>
                    <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

        <h3 class="card-title text-center" style="color: black;"><?= __('Enfrentamientos de PlayOffs Grupo ').h($grupo->id) ?></h3>
        <?php if (!empty($iterador)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Fecha') ?></th>
                <th scope="col"><?= __('Id de reserva de pista') ?></th>
                <th scope="col"><?= __('Fase del Campeonato') ?></th>
                <th scope="col" class="actions">Acciones</th>
            </tr>
            <?php foreach ($iterador as $enfrentamiento): 
                if($enfrentamiento['fase'] == "playoffs4" || $enfrentamiento['fase'] == "playoffs2" || $enfrentamiento['fase'] == "playoffs1" || $enfrentamiento['fase'] == "playoffse"):
            ?>
            <tr>
                <td><?= h($enfrentamiento->id) ?></td>
                <td><?= h($enfrentamiento->nombre) ?></td>
                <td><?= h($enfrentamiento->fecha) ?></td>
                <td><?php echo (h($enfrentamiento->reserva_id) == "") ? "No hay reserva" :  h($enfrentamiento->reserva_id); ?></td>
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
            </tr>
                    <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div> 