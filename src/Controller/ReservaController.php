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
        $this->paginate = [
            'contain' => ['Pista', 'Usuario', 'Enfrentamiento', 'PartidoPromocionado'],
            'order' => [
                'Reserva.fecha' => 'desc'
            ]
        ];
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
            'contain' => ['Pista', 'Usuario', 'Enfrentamiento', 'PartidoPromocionado']
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
        if ($this->request->is('post')) {
            $reserva = $this->Reserva->newEntity($this->request->getData());

            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('{0} creada con éxito.', __('Reserva')));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        } else {
            $reserva = $this->Reserva->newEntity();
        }

        $pista = $this->Reserva->Pista->find('list', ['limit' => 200]);
        $usuario = $this->Reserva->Usuario->find('list', ['limit' => 200]);

        $this->set(compact('reserva', 'pista', 'usuario'));
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('The reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reserva could not be saved. Please, try again.'));
        }
        $pista = $this->Reserva->Pista->find('list', ['limit' => 200]);
        $usuario = $this->Reserva->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('reserva', 'pista', 'usuario'));
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
