<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

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
     * Initializes the controller
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // Allow not logged in users to use this controller in debug mode
        if (Configure::read('debug')) {
            $this->Auth->allow(['index', 'view', 'add', 'edit', 'delete']);
        }
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pista = $this->Pista->newEntity();
        if ($this->request->is('post')) {
            $pista = $this->Pista->patchEntity($pista, $this->request->getData());
            if ($this->Pista->save($pista)) {
                $this->Flash->success(__('{0} creada con éxito.', __('Pista')));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }
        $this->set(compact('pista'));
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
     * @param string|null $id Pistum id.
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
