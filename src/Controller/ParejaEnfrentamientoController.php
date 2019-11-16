<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ParejaEnfrentamiento Controller
 *
 * @property \App\Model\Table\ParejaEnfrentamientoTable $ParejaEnfrentamiento
 *
 * @method \App\Model\Entity\ParejaEnfrentamiento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParejaEnfrentamientoController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $parejaEnfrentamiento = $this->paginate($this->ParejaEnfrentamiento);

        $this->set(compact('parejaEnfrentamiento'));
    }

    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), []) ||
               $user['rol'] === 'administrador';

    }
    /**
     * View method
     *
     * @param string|null $id Pareja Enfrentamiento id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parejaEnfrentamiento = $this->ParejaEnfrentamiento->get($id, [
            'contain' => []
        ]);

        $this->set('parejaEnfrentamiento', $parejaEnfrentamiento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parejaEnfrentamiento = $this->ParejaEnfrentamiento->newEntity();
        if ($this->request->is('post')) {
            $parejaEnfrentamiento = $this->ParejaEnfrentamiento->patchEntity($parejaEnfrentamiento, $this->request->getData());
            if ($this->ParejaEnfrentamiento->save($parejaEnfrentamiento)) {
                $this->Flash->success(__('The pareja enfrentamiento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pareja enfrentamiento could not be saved. Please, try again.'));
        }
        $this->set(compact('parejaEnfrentamiento'));
    }

    public function add2($var)
    {
        $parejaEnfrentamiento = $this->ParejaEnfrentamiento->newEntity();
        $parejaEnfrentamiento = $this->ParejaEnfrentamiento->patchEntity($parejaEnfrentamiento, $var);
            if ($this->ParejaEnfrentamiento->save($parejaEnfrentamiento)) {

                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('The pareja enfrentamiento could not be saved. Please, try again.'));
            }
    }

    /**
     * Edit method
     *
     * @param string|null $id Pareja Enfrentamiento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parejaEnfrentamiento = $this->ParejaEnfrentamiento->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parejaEnfrentamiento = $this->ParejaEnfrentamiento->patchEntity($parejaEnfrentamiento, $this->request->getData());
            if ($this->ParejaEnfrentamiento->save($parejaEnfrentamiento)) {
                $this->Flash->success(__('The pareja enfrentamiento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pareja enfrentamiento could not be saved. Please, try again.'));
        }
        $this->set(compact('parejaEnfrentamiento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pareja Enfrentamiento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parejaEnfrentamiento = $this->ParejaEnfrentamiento->get($id);
        if ($this->ParejaEnfrentamiento->delete($parejaEnfrentamiento)) {
            $this->Flash->success(__('The pareja enfrentamiento has been deleted.'));
        } else {
            $this->Flash->error(__('The pareja enfrentamiento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
