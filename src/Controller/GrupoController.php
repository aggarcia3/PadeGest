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