<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pago Controller
 *
 * @property \App\Model\Table\PagoTable $Pago
 *
 * @method \App\Model\Entity\Pago[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuario']
        ];
        $pago = $this->paginate($this->Pago);

        $this->set(compact('pago'));
    }

    /**
     * View method
     *
     * @param string|null $id Pago id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pago = $this->Pago->get($id, [
            'contain' => ['Usuario']
        ]);

        $this->set('pago', $pago);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pago = $this->Pago->newEntity();
        if ($this->request->is('post')) {
            $pago = $this->Pago->patchEntity($pago, $this->request->getData());
            if ($this->Pago->save($pago)) {
                $this->Flash->success(__('The pago has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pago could not be saved. Please, try again.'));
        }
        $usuario = $this->Pago->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('pago', 'usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pago id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pago = $this->Pago->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pago = $this->Pago->patchEntity($pago, $this->request->getData());
            if ($this->Pago->save($pago)) {
                $this->Flash->success(__('The pago has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pago could not be saved. Please, try again.'));
        }
        $usuario = $this->Pago->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('pago', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pago id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pago = $this->Pago->get($id);
        if ($this->Pago->delete($pago)) {
            $this->Flash->success(__('The pago has been deleted.'));
        } else {
            $this->Flash->error(__('The pago could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
