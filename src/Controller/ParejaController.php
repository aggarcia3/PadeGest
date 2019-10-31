<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $pareja = $this->Pareja->newEntity();
        if ($this->request->is('post')) {
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
