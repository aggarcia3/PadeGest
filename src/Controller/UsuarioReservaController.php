<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsuarioReserva Controller
 *
 * @property \App\Model\Table\UsuarioReservaTable $UsuarioReserva
 *
 * @method \App\Model\Entity\UsuarioReserva[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuarioReservaController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $usuarioReserva = $this->paginate($this->UsuarioReserva);

        $this->set(compact('usuarioReserva'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario Reserva id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuarioReserva = $this->UsuarioReserva->get($id, [
            'contain' => []
        ]);

        $this->set('usuarioReserva', $usuarioReserva);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuarioReserva = $this->UsuarioReserva->newEntity();
        if ($this->request->is('post')) {
            $usuarioReserva = $this->UsuarioReserva->patchEntity($usuarioReserva, $this->request->getData());
            if ($this->UsuarioReserva->save($usuarioReserva)) {
                $this->Flash->success(__('The usuario reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario reserva could not be saved. Please, try again.'));
        }
        $this->set(compact('usuarioReserva'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario Reserva id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuarioReserva = $this->UsuarioReserva->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuarioReserva = $this->UsuarioReserva->patchEntity($usuarioReserva, $this->request->getData());
            if ($this->UsuarioReserva->save($usuarioReserva)) {
                $this->Flash->success(__('The usuario reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario reserva could not be saved. Please, try again.'));
        }
        $this->set(compact('usuarioReserva'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario Reserva id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuarioReserva = $this->UsuarioReserva->get($id);
        if ($this->UsuarioReserva->delete($usuarioReserva)) {
            $this->Flash->success(__('The usuario reserva has been deleted.'));
        } else {
            $this->Flash->error(__('The usuario reserva could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
