<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pista Controller
 *
 * @property \App\Model\Table\PistaTable $Pista
 *
 * @method \App\Model\Entity\Pista[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PistaController extends AppController
{
    /**
     * Checks whether the user is authorized to perform a request
     *
     * @param mixed $user The user to authenticate
     * @return bool
     */
    public function isAuthorized($user = [])
    {
        return $user['rol'] === 'administrador';
    }

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
     * @param string|null $id Pista id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pista = $this->Pista->get($id, [
            'contain' => ['Reserva']
        ]);

        $this->set(compact('pista'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $pista = $this->Pista->newEntity($this->request->getData());

            if ($this->Pista->save($pista)) {
                $this->Flash->success(__('{0} creada con éxito.', __('Pista')));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        } else {
            $pista = $this->Pista->newEntity();
        }

        $this->set(compact('pista'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pista id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pista = $this->Pista->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pista = $this->Pista->patchEntity($pista, $this->request->getData());
            if ($this->Pista->save($pista)) {
                $this->Flash->success(__('{0} editada con éxito.', [__('Pista')]));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }
        $this->set(compact('pista'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pista id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pista = $this->Pista->get($id);
        if ($this->Pista->delete($pista)) {
            $this->Flash->success(__('{0} borrada con éxito.', __('Pista')));
        } else {
            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
