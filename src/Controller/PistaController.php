<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

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
     * Comprueba que el usuario conectado tenga los privilegios suficientes para interactuar
     * con este controlador. Este método no se invoca para usuarios no conectados: en ese caso,
     * las restricciones por defecto especificadas con el método allow de AuthComponent se aplican
     * exclusivamente.
     *
     * @param array|\ArrayAccess $user El usuario conectado.
     * @return bool Verdadero si se le debe de conceder acceso a la acción al usuario, falso en
     * caso contrario.
     */
    public function isAuthorized($user)
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
        try {
            $pista = $this->Pista->get($id, [
                'contain' => ['Reserva']
            ]);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe.', __('pista')));

            $this->viewBuilder()->setTemplate('index');

            $this->index();
        }

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
     */
    public function edit($id = null)
    {
        try {
            $pista = $this->Pista->get($id);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe, por lo que no se puede editar.', __('pista')));

            return $this->redirect(['action' => 'index']);
        }

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
     * @return \Cake\Http\Response Redirecciona al índice.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        try {
            $pista = $this->Pista->get($id);

            if ($this->Pista->delete($pista)) {
                $this->Flash->success(__('{0} borrada con éxito.', __('Pista')));
            } else {
                $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
            }
        } catch (RecordNotFoundException $_) {
            // Ignorar el error
            $this->Flash->success(__('{0} borrada con éxito.', __('Pista')));
        }

        return $this->redirect(['action' => 'index']);
    }
}
