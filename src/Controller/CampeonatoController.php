<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
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
     * Index method
     *
     * @return void
     */
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
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);

        $this->set('campeonato', $campeonato);
    }

    public function index()
    {
        $campeonato = $this->paginate($this->Campeonato);

        $this->set(compact('campeonato'));
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
            'contain' => []
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
            $campeonato = $this->Campeonato->patchEntity($campeonato, $this->request->getData());
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                $resultsIteratorObject = $this->Campeonato->find()->where(['nombre' => $var])->all();
                foreach ($resultsIteratorObject as $campeonato) {
                    $var2 = $campeonato->id;
                }
                
                $CategoriaNivel = (new CategoriaNivelController());
                $categoria1['campeonato_id'] = $var2;
                $categoria1['categoria'] = 'masculina';
                $categoria1['nivel'] = '1';
                $CategoriaNivel->add2($categoria1);

                $categoria2['campeonato_id'] = $var2;
                $categoria2['categoria'] = 'femenina';
                $categoria2['nivel'] = '1';
                $CategoriaNivel->add2($categoria2);

                $categoria3['campeonato_id'] = $var2;
                $categoria3['categoria'] = 'mixta';
                $categoria3['nivel'] = '1';
                $CategoriaNivel->add2($categoria3);

                $categoria4['campeonato_id'] = $var2;
                $categoria4['categoria'] = 'masculina';
                $categoria4['nivel'] = '2';
                $CategoriaNivel->add2($categoria4);

                $categoria5['campeonato_id'] = $var2;
                $categoria5['categoria'] = 'femenina';
                $categoria5['nivel'] = '2';
                $CategoriaNivel->add2($categoria5);

                $categoria6['campeonato_id'] = $var2;
                $categoria6['categoria'] = 'mixta';
                $categoria6['nivel'] = '2';
                $CategoriaNivel->add2($categoria6);

                $categoria7['campeonato_id'] = $var2;
                $categoria7['categoria'] = 'masculina';
                $categoria7['nivel'] = '3';
                $CategoriaNivel->add2($categoria7);

                $categoria8['campeonato_id'] = $var2;
                $categoria8['categoria'] = 'femenina';
                $categoria8['nivel'] = '3';
                $CategoriaNivel->add2($categoria8);

                $categoria8['campeonato_id'] = $var2;
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
            'contain' => []
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
     * @return \Cake\Http\Response|null Redirects to index.
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

        return 0;
    }

    public function agrupar(){
        $i = 0;
        $fecha_actual = FrozenTime::now();
        $campeonatos = $this->Campeonato->find('all');
        foreach($campeonatos as $campeonato){
            if($campeonato['fechaFinInscripciones'] <  $fecha_actual){
                $var[$i] = $campeonato['id'];
                $this->obtenerCategoriaNivel($campeonato['id']);
                $i++;
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function obtenerCategoriaNivel($var){
        $j = 0;
        $categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
        $resultsIteratorObject = $categoriaNivel->find()->where(['campeonato_id' => $var])->all();

        foreach ($resultsIteratorObject as $categoriaNivel) {
            $var2[$j] = $categoriaNivel['id'];
            $this->obtenerParejas($categoriaNivel['id']);
        }
        return 0;
    }

    public function obtenerParejas($var){
        $l = 0;
        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $resultsIteratorObject2 = $pareja->find()->where(['categoria_nivel_id' => $var])->all();
        foreach ($resultsIteratorObject2 as $pareja) {
            $var3[$l] = $pareja['id'];
            $l++;
        }
        if(isset($var3) && sizeof($var3)>= 8){
            $numeroGrupos = intval(sizeof($var3)/8);

            $grupo = TableRegistry::getTableLocator()->get('Grupo');
            $resultsIteratorObject6 = $grupo->find()->where(['categoria_nivel_id' => $var])->all();
            $f = 0;
            foreach ($resultsIteratorObject6 as $grupo) {
                $var5[$f] = $grupo['id'];
                $f++;
            }
            if(sizeof($var5) == 0){
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
            if(isset($var4)){
                $x = 0;
                $parejaController = (new ParejaController());
                for ($s = 0; $s < sizeof($var3); $s++) {
                    if($x == sizeof($var4)){
                        $x = 0;
                    }
                    $parejaGrupo['grupo_id'] = $var4[$x];
                    $parejaController->edit2($var3[$s],$parejaGrupo);
                    $x++;
                }
            }


            $parejas = TableRegistry::getTableLocator()->get('Pareja');
            foreach ($resultsIteratorObject3 as $grupo) {
                $resultsIteratorObject4 = $parejas->find()->where(['grupo_id' => $grupo['id']])->all();
                $resultsIteratorObject5 = $parejas->find()->where(['grupo_id' => $grupo['id']])->all();
                $matchs = array();
                foreach($resultsIteratorObject4 as $k){
                    foreach($resultsIteratorObject5 as $j){
                        if($k['id'] == $j['id']){
                            continue;
                        }
                        $z = array($k['id'],$j['id']);
                        sort($z);
                        if(!in_array($z,$matchs)){
                            $matchs[] = $z;
                        }
                    }
                }
                for ($s = 0; $s < sizeof($matchs); $s++) {
                    $enfrentamiento = (new EnfrentamientoController());
                    $data['nombre'] = 'Grupo'.$grupo['id'].$s;
                    $data['fase'] = 'liga regular';
                    $data['fecha'] = '1000-01-01 00:00:00';
                    $enfrentamiento->add2($data);
                }


                $indice = 0;
                $partidos = TableRegistry::getTableLocator()->get('Enfrentamiento');
                $parejaEnfrentamiento = (new ParejaEnfrentamientoController());
                $resultsIteratorObject5 = $partidos->find()->where(['nombre LIKE' => "Grupo".$grupo['id']."%"])->all();
                foreach($resultsIteratorObject5 as $idPartidos){

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
