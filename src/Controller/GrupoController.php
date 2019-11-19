<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Grupo Controller
 *
 * @property \App\Model\Table\GrupoTable $Grupo
 *
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GrupoController extends AppController
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
        return in_array($this->request->getParam('action'), ['register','index', 'logout', 'edit']) ||
               $user['rol'] === 'administrador';
    }
    public function index()
    {
        $grupo = $this->paginate($this->Grupo);
        $this->set(compact('grupo'));
    }
    /**
     * View method
     *
     * @param string|null $id Grupo id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);

        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $resultsIteratorObject3 = $pareja->find()->where(['grupo_id' => $id])->all();
        $this->set(compact('grupo', 'resultsIteratorObject3'));
    }
    public function ligaRegular($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);

        $auxiliar= array();
        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $usuario = TableRegistry::getTableLocator()->get('Usuario');
        $enfrentamiento = TableRegistry::getTableLocator()->get('Enfrentamiento');
        $resultsIteratorObject3 = $pareja->find()->where(['grupo_id' => $id])->all();
        $iterador = $enfrentamiento->find()->join(
            [
            'P' => [ 'table' => 'Pareja_enfrentamiento',
            'type' => 'INNER',
            'conditions' => 'Enfrentamiento.id=P.enfrentamiento_id',
            ],
            'L' =>[
                'table'=> 'Pareja',
                'type'=>'INNER',
                'conditions'=> 'L.id=P.pareja_id',
            ]
        ])->where(['grupo_id'=>$id,'fase'=>"liga regular"])->group('Enfrentamiento.id')->all();
        $this->set(compact('grupo', 'resultsIteratorObject3', 'iterador'));
    }
    public function Playoffs($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);


        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $usuario = TableRegistry::getTableLocator()->get('Usuario');
        $enfrentamiento = TableRegistry::getTableLocator()->get('Enfrentamiento');
        $resultsIteratorObject3 = $pareja->find()->where(['grupo_id' => $id])->limit(8)->order(['puntuacion'=>'DESC']);

        $iterador = $enfrentamiento->find()->join(
            [
            'P' => [ 'table' => 'Pareja_enfrentamiento',
            'type' => 'INNER',
            'conditions' => 'Enfrentamiento.id=P.enfrentamiento_id',
            ],
            'L' =>[
                'table'=> 'Pareja',
                'type'=>'INNER',
                'conditions'=> 'L.id=P.pareja_id',
            ]
        ])->  where([['fase'=>'playoffse']or['fase'=>'playoffs1']or['fase'=>'playoffs2']or['fase'=>'playoffs4']])->group('Enfrentamiento.id');


        $this->set(compact('grupo', 'resultsIteratorObject3', 'iterador'));
    }

    public function generarPlayoffs($id = null)
    {

        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);
        $enfrentamiento = TableRegistry::getTableLocator()->get('Enfrentamiento');
        $parejaenfrentamiento = TableRegistry::getTableLocator()->get('Pareja_enfrentamiento');
        $resultados = TableRegistry::getTableLocator()->get('Resultado');
        $enfrentamiento1 = $enfrentamiento->newEntity();
        $enfrentamiento2 = $enfrentamiento->newEntity();
        $enfrentamiento3 = $enfrentamiento->newEntity();
        $enfrentamiento4 = $enfrentamiento->newEntity();
        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $resultsIteratorObject3 = $pareja->find()->where(['grupo_id' => $id])->limit(8)->order(['puntuacion'=>'DESC'])->all();
        $enfrentamiento1->nombre = "Playoffs grupo ". $id." Enfrentamiento1";
        $enfrentamiento2->nombre = "Playoffs grupo ". $id." Enfrentamiento2";
        $enfrentamiento3->nombre = "Playoffs grupo ". $id." Enfrentamiento3";
        $enfrentamiento4->nombre = "Playoffs grupo ". $id." Enfrentamiento4";
        $enfrentamiento1->fecha = '2019-12-19 16:00:';
        $enfrentamiento2->fecha = '2019-12-19 16:00:';
        $enfrentamiento3->fecha = '2019-12-19 16:00:';
        $enfrentamiento4->fecha = '2019-12-19 16:00:';
        $enfrentamiento1->fase= 'playoffs4';
        $enfrentamiento2->fase= 'playoffs4';
        $enfrentamiento3->fase= 'playoffs4';
        $enfrentamiento4->fase= 'playoffs4';
        $enfrentamiento1->reserva_id = null;
        $enfrentamiento2->reserva_id = null;
        $enfrentamiento3->reserva_id = null;
        $enfrentamiento4->reserva_id = null;
        if (!$enfrentamiento->save($enfrentamiento1)) {
            $this->Flash->success(__('Ya se han generado los  primeros enfrentamientos del playoff'));
            return $this->redirect(['action'=>'Playoffs',$grupo->id]);
        }
        $id1 = $enfrentamiento1->id;
        $enfrentamiento->save($enfrentamiento2);
        $id2 = $enfrentamiento2->id;
        $enfrentamiento->save($enfrentamiento3);
        $id3 = $enfrentamiento3->id;
        $enfrentamiento->save($enfrentamiento4);
        $id4 = $enfrentamiento4->id;
        $auxiliar=0;
        foreach( $resultsIteratorObject3 as $pareja1):

            $nuevarelacion = $parejaenfrentamiento->newEntity();
            if($auxiliar == 0 || $auxiliar ==7) {
                $nuevarelacion->pareja_id = $pareja1->id;
                $nuevarelacion->enfrentamiento_id = $id1;
            }elseif($auxiliar ==1 || $auxiliar == 6) {
                $nuevarelacion->pareja_id = $pareja1->id;
                $nuevarelacion->enfrentamiento_id = $id2;
            }elseif($auxiliar ==2 || $auxiliar == 5) {
                $nuevarelacion->pareja_id = $pareja1->id;
                $nuevarelacion->enfrentamiento_id = $id3;
            }else{
                $nuevarelacion->pareja_id = $pareja1->id;
                $nuevarelacion->enfrentamiento_id = $id4;
            }
            $auxiliar++;
            $nuevarelacion->participacionConfirmada=0;
            $parejaenfrentamiento->save($nuevarelacion);

        endforeach;


        return $this->redirect(['action'=>'Playoffs',$grupo->id]);
    }

    public function ligaRegular($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);
        $auxiliar= array();
        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $enfrentamiento = TableRegistry::getTableLocator()->get('Enfrentamiento');
        $resultsIteratorObject3 = $pareja->find()->where(['grupo_id' => $id])->all();
        $iterador = $enfrentamiento->find()->join(
            [
            'P' => [ 'table' => 'Pareja_enfrentamiento',
            'type' => 'INNER',
            'conditions' => 'Enfrentamiento.id=P.enfrentamiento_id',
            ],
            'L' =>[
                'table'=> 'Pareja',
                'type'=>'INNER',
                'conditions'=> 'L.id=P.pareja_id',
            ]
        ])->where(['grupo_id'=>$id])->group('Enfrentamiento.id')->all();
        $this->set(compact('grupo', 'resultsIteratorObject3', 'iterador'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grupo = $this->Grupo->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupo->patchEntity($grupo, $this->request->getData());
            if ($this->Grupo->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }
        $this->set(compact('grupo'));
    }
    public function add2($var)
    {
        $grupo = $this->Grupo->newEntity();
        $grupo = $this->Grupo->patchEntity($grupo, $var);
        if ($this->Grupo->save($grupo)) {
            return $this->redirect(['action' => 'index']);
        }else{
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }

        $this->set(compact('grupo'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grupo = $this->Grupo->patchEntity($grupo, $this->request->getData());
            if ($this->Grupo->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }
        $this->set(compact('grupo'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grupo = $this->Grupo->get($id);
        if ($this->Grupo->delete($grupo)) {
            $this->Flash->success(__('The grupo has been deleted.'));
        } else {
            $this->Flash->error(__('The grupo could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
