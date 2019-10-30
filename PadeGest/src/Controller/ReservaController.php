<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reserva Controller
 *
 * @property \App\Model\Table\ReservaTable $Reserva
 *
 * @method \App\Model\Entity\Reserva[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $reserva = $this->paginate($this->Reserva);

        $this->set(compact('reserva'));
    }

    /**
     * View method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reserva = $this->Reserva->get($id, [
            'contain' => ['Usuario']
        ]);

        $this->set('reserva', $reserva);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reserva = $this->Reserva->newEntity();
        if ($this->request->is('post')) {
            $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('The reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reserva could not be saved. Please, try again.'));
        }
        $usuario = $this->Reserva->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('reserva', 'usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reserva = $this->Reserva->get($id, [
            'contain' => ['Usuario']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('The reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reserva could not be saved. Please, try again.'));
        }
        $usuario = $this->Reserva->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('reserva', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reserva = $this->Reserva->get($id);
        if ($this->Reserva->delete($reserva)) {
            $this->Flash->success(__('The reserva has been deleted.'));
        } else {
            $this->Flash->error(__('The reserva could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
