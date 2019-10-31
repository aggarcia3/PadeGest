<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pista Controller
 *
 * @property \App\Model\Table\PistaTable $Pista
 *
 * @method \App\Model\Entity\Pistum[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PistaController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $pista = $this->paginate($this->Pista);

        $this->set(compact('pista'));
    }

    /**
     * View method
     *
     * @param string|null $id Pistum id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pistum = $this->Pista->get($id, [
            'contain' => []
        ]);

        $this->set('pistum', $pistum);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pistum = $this->Pista->newEntity();
        if ($this->request->is('post')) {
            $pistum = $this->Pista->patchEntity($pistum, $this->request->getData());
            if ($this->Pista->save($pistum)) {
                $this->Flash->success(__('The pistum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pistum could not be saved. Please, try again.'));
        }
        $this->set(compact('pistum'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pistum id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pistum = $this->Pista->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pistum = $this->Pista->patchEntity($pistum, $this->request->getData());
            if ($this->Pista->save($pistum)) {
                $this->Flash->success(__('The pistum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pistum could not be saved. Please, try again.'));
        }
        $this->set(compact('pistum'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pistum id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pistum = $this->Pista->get($id);
        if ($this->Pista->delete($pistum)) {
            $this->Flash->success(__('The pistum has been deleted.'));
        } else {
            $this->Flash->error(__('The pistum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
