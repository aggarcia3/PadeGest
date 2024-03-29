<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Campeonato Controller
 *
 * @property \App\Model\Table\CampeonatoTable $Campeonato
 *
 * @method \App\Model\Entity\Campeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CampeonatoController extends AppController
{
    /**
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $partidoPromocionado = (new PartidoPromocionadoController());
        $this->agrupar();
        $partidoPromocionado->agrupar();
    }

    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['view', 'index', 'inscribirse']) ||
            $user['rol'] === 'administrador';
    }

    public function inscribirse($id = null)
    {
        $fecha_actual = FrozenTime::now();
        $campeonato = $this->Campeonato->get($id, [
            'contain' => [],
        ]);

        if ($campeonato['fechaFinInscripciones'] <  $fecha_actual) {
            $this->Flash->error(__('No puedes acceder a esta URL, se notificará al administrador'));

            return $this->redirect(['action' => 'index']);
        }
        $this->set('campeonato', $campeonato);
    }

    public function index()
    {
        $campeonatos = $this->paginate($this->Campeonato);

        if ($this->Auth->user('rol') != "administrador") {
            $fecha_actual = FrozenTime::now();

            foreach ($campeonatos as $campeonato) {
                if ($campeonato['fechaFinInscripciones'] < $fecha_actual) {
                    unset($campeonato['fechaFinInscripciones']);
                    unset($campeonato['nombre']);
                    unset($campeonato['id']);
                    unset($campeonato['bases']);
                    unset($campeonato['fechaInicioInscripciones']);
                }
            }
        }

        $this->set(compact('campeonatos'));
    }

    /**
     * View method
     *
     * @param string|null $id Campeonato id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => [],
        ]);

        $categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
        $resultsIteratorObject = $categoriaNivel->find()->where(['campeonato_id' => $id])->all();

        $this->set(compact('campeonato', 'resultsIteratorObject'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $campeonato = $this->Campeonato->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $var = $data['nombre'];

            $data['fechaInicioInscripciones'] =  $data['fechaInicioInscripciones'] . ' 00:00:00';
            $data['fechaFinInscripciones'] =  $data['fechaFinInscripciones'] . ' 00:00:00';
            $campeonato = $this->Campeonato->patchEntity($campeonato, $data);
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                $ultimoId = $this->Campeonato->find()->where(['nombre' => $var])->last()->id;

                $CategoriaNivel = (new CategoriaNivelController());
                $categoria1['campeonato_id'] = $ultimoId;
                $categoria1['categoria'] = 'masculina';
                $categoria1['nivel'] = '1';
                $CategoriaNivel->add2($categoria1);

                $categoria2['campeonato_id'] = $ultimoId;
                $categoria2['categoria'] = 'femenina';
                $categoria2['nivel'] = '1';
                $CategoriaNivel->add2($categoria2);

                $categoria3['campeonato_id'] = $ultimoId;
                $categoria3['categoria'] = 'mixta';
                $categoria3['nivel'] = '1';
                $CategoriaNivel->add2($categoria3);

                $categoria4['campeonato_id'] = $ultimoId;
                $categoria4['categoria'] = 'masculina';
                $categoria4['nivel'] = '2';
                $CategoriaNivel->add2($categoria4);

                $categoria5['campeonato_id'] = $ultimoId;
                $categoria5['categoria'] = 'femenina';
                $categoria5['nivel'] = '2';
                $CategoriaNivel->add2($categoria5);

                $categoria6['campeonato_id'] = $ultimoId;
                $categoria6['categoria'] = 'mixta';
                $categoria6['nivel'] = '2';
                $CategoriaNivel->add2($categoria6);

                $categoria7['campeonato_id'] = $ultimoId;
                $categoria7['categoria'] = 'masculina';
                $categoria7['nivel'] = '3';
                $CategoriaNivel->add2($categoria7);

                $categoria8['campeonato_id'] = $ultimoId;
                $categoria8['categoria'] = 'femenina';
                $categoria8['nivel'] = '3';
                $CategoriaNivel->add2($categoria8);

                $categoria8['campeonato_id'] = $ultimoId;
                $categoria8['categoria'] = 'mixta';
                $categoria8['nivel'] = '3';
                $CategoriaNivel->add2($categoria8);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campeonato could not be saved. Please, try again.'));
        }
        $this->set(compact('campeonato'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Campeonato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $campeonato = $this->Campeonato->patchEntity($campeonato, $this->request->getData());
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campeonato could not be saved. Please, try again.'));
        }
        $this->set(compact('campeonato'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Campeonato id.
     * @return \Cake\Http\Response Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $campeonato = $this->Campeonato->get($id);
        if ($this->Campeonato->delete($campeonato)) {
            $this->Flash->success(__('The campeonato has been deleted.'));
        } else {
            $this->Flash->error(__('The campeonato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function agrupar()
    {
        $fecha_actual = FrozenTime::now();
        $campeonatos = $this->Campeonato->find('all');
        foreach ($campeonatos as $campeonato) {
            if ($campeonato['fechaFinInscripciones'] <  $fecha_actual) {
                $this->obtenerCategoriaNivel($campeonato['id']);
            }
        }
    }

    public function obtenerCategoriaNivel($var)
    {
        $categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
        $resultsIteratorObject = $categoriaNivel->find()->where(['campeonato_id' => $var])->all();

        foreach ($resultsIteratorObject as $categoriaNivel) {
            $this->obtenerParejas($categoriaNivel['id']);
        }

        return 0;
    }

    public function obtenerParejas($var)
    {
        $l = 0;
        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $resultsIteratorObject2 = $pareja->find()->where(['categoria_nivel_id' => $var])->all();
        foreach ($resultsIteratorObject2 as $pareja) {
            $var3[$l] = $pareja['id'];
            $l++;
        }
        if (isset($var3) && count($var3) >= 8) {
            $numeroGrupos = intval(count($var3) / 8);

            $grupo = TableRegistry::getTableLocator()->get('Grupo');
            $resultsIteratorObject6 = $grupo->find()->where(['categoria_nivel_id' => $var])->all();
            $f = 0;
            foreach ($resultsIteratorObject6 as $grupo) {
                $var5[$f] = $grupo['id'];
                $f++;
            }
            if (!isset($var5)) {
                $grupo = (new GrupoController());
                for ($t = 0; $t < $numeroGrupos; $t++) {
                    $grupoValues['categoria_nivel_id'] = $var;
                    $grupo->add2($grupoValues);
                }
            }

            $grupo = TableRegistry::getTableLocator()->get('Grupo');
            $resultsIteratorObject3 = $grupo->find()->where(['categoria_nivel_id' => $var])->all();
            $k = 0;
            foreach ($resultsIteratorObject3 as $grupo) {
                $var4[$k] = $grupo['id'];
                $k++;
            }
            if (isset($var4)) {
                $x = 0;
                $parejaController = (new ParejaController());
                for ($s = 0; $s < count($var3); $s++) {
                    if ($x == count($var4)) {
                        $x = 0;
                    }
                    $parejaGrupo['grupo_id'] = $var4[$x];
                    $parejaController->edit2($var3[$s], $parejaGrupo);
                    $x++;
                }
            }

            $parejas = TableRegistry::getTableLocator()->get('Pareja');
            foreach ($resultsIteratorObject3 as $grupo) {
                $resultsIteratorObject4 = $parejas->find()->where(['grupo_id' => $grupo['id']])->all();
                $resultsIteratorObject5 = $parejas->find()->where(['grupo_id' => $grupo['id']])->all();
                $matchs = [];
                foreach ($resultsIteratorObject4 as $k) {
                    foreach ($resultsIteratorObject5 as $j) {
                        if ($k['id'] == $j['id']) {
                            continue;
                        }
                        $z = [$k['id'], $j['id']];
                        sort($z);
                        if (!in_array($z, $matchs)) {
                            $matchs[] = $z;
                        }
                    }
                }
                for ($s = 0; $s < count($matchs); $s++) {
                    $enfrentamiento = (new EnfrentamientoController());
                    $data['nombre'] = 'Grupo' . $grupo['id'] . $s;
                    $data['fase'] = 'liga regular';
                    $data['fecha'] = '1000-01-01 00:00:00';
                    $enfrentamiento->add2($data);
                }

                $indice = 0;
                $partidos = TableRegistry::getTableLocator()->get('Enfrentamiento');
                $parejaEnfrentamiento = (new ParejaEnfrentamientoController());
                $resultsIteratorObject5 = $partidos->find()->where(['nombre LIKE' => "Grupo" . $grupo['id'] . "%"])->all();
                foreach ($resultsIteratorObject5 as $idPartidos) {
                    $data4['pareja_id'] = $matchs[$indice][0];
                    $data4['enfrentamiento_id'] = $idPartidos['id'];
                    $data4['participacionConfirmada'] = 0;
                    $parejaEnfrentamiento->add2($data4);

                    $data5['pareja_id'] = $matchs[$indice][1];
                    $data5['enfrentamiento_id'] = $idPartidos['id'];
                    $data5['participacionConfirmada'] = 0;
                    $parejaEnfrentamiento->add2($data5);
                    $indice++;
                }
            }
        }

        return 0;
    }
}
