<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Pareja Controller
 *
 * @property \App\Model\Table\ParejaTable $Pareja
 *
 * @method \App\Model\Entity\Pareja[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParejaController extends AppController
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
        return in_array($this->request->getParam('action'), ['add', 'view']) ||
               $user['rol'] === 'administrador';

    }

    public function index()
    {
        $pareja = $this->paginate($this->Pareja);

        $this->set(compact('pareja'));
    }

    /**
     * View method
     *
     * @param string|null $id Pareja id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pareja = $this->Pareja->get($id, [
            'contain' => ['Enfrentamiento']
        ]);

        $this->set('pareja', $pareja);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();
        $usuario = TableRegistry::getTableLocator()->get('Usuario');
        $resultsIteratorObject = $usuario->find()->where(['username' => $data['usernameCapitan']])->all();
        $resultsIteratorObject2 = $usuario->find()->where(['username' => $data['usernamePareja']])->all();

        $categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
        $resultsIteratorObject3 = $categoriaNivel->find()->where(['campeonato_id' => $data['campeonatoId']])->all();

        foreach ($resultsIteratorObject as $usuario) {
            $var = $usuario->id;
        }

        foreach ($resultsIteratorObject2 as $usuario) {
            $var2 = $usuario->id;
        }
        foreach ($resultsIteratorObject3 as $categoriaNivel) {
            if($data['categoria'] == $categoriaNivel['categoria'] && $data['nivel'] == $categoriaNivel['nivel']){
                $var3 = $categoriaNivel['id'];
            }
        }

        $pareja = $this->Pareja->newEntity();

        $data['idCapitan'] = $var;
        $data['idCompanero'] = $var2;
        $data['categoria_nivel_id'] = $var3;
        $data['grupo_id'] = null;

        unset($data['usernameCapitan']);     
        unset($data['usernamePareja']);    
        unset($data['categoria']);
        unset($data['nivel']); 
        unset($data['nivel']); 
        unset($data['campeonatoId']); 

        if ($this->request->is('post')) {
            $pareja = $this->Pareja->patchEntity($pareja, $data);
            if ($this->Pareja->save($pareja)) {
                $this->Flash->success(__('The pareja has been saved.'));

                return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
            }
            $this->Flash->error(__('The pareja could not be saved. Please, try again.'));
            return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
        }
        $enfrentamiento = $this->Pareja->Enfrentamiento->find('list', ['limit' => 200]);
        $this->set(compact('pareja', 'enfrentamiento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pareja id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pareja = $this->Pareja->get($id, [
            'contain' => ['Enfrentamiento']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pareja = $this->Pareja->patchEntity($pareja, $this->request->getData());
            if ($this->Pareja->save($pareja)) {
                $this->Flash->success(__('The pareja has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pareja could not be saved. Please, try again.'));
        }
        $enfrentamiento = $this->Pareja->Enfrentamiento->find('list', ['limit' => 200]);
        $this->set(compact('pareja', 'enfrentamiento'));
    }
    public function edit2($var, $var2)
    {
        $pareja = $this->Pareja->get($var, [
            'contain' => ['Enfrentamiento']
        ]);
            $pareja = $this->Pareja->patchEntity($pareja, $var2);
            if ($this->Pareja->save($pareja)) {
                $this->Flash->success(__('The pareja has been saved.'));

                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('The pareja could not be saved. Please, try again.'));
            }
        $enfrentamiento = $this->Pareja->Enfrentamiento->find('list', ['limit' => 200]);
        $this->set(compact('pareja', 'enfrentamiento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pareja id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pareja = $this->Pareja->get($id);
        if ($this->Pareja->delete($pareja)) {
            $this->Flash->success(__('The pareja has been deleted.'));
        } else {
            $this->Flash->error(__('The pareja could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
