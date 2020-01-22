<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clase Controller
 *
 * @property \App\Model\Table\ClaseTable $Clase
 *
 * @method \App\Model\Entity\Clase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClaseController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $clase = $this->paginate($this->Clase);

        $this->set(compact('clase'));
    }

    /**
     * View method
     *
     * @param string|null $id Clase id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clase = $this->Clase->get($id, [
            'contain' => ['Usuario', 'Reserva']
        ]);

        $this->set('clase', $clase);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clase = $this->Clase->newEntity();
        if ($this->request->is('post')) {
            $clase = $this->Clase->patchEntity($clase, $this->request->getData());
            if ($this->Clase->save($clase)) {
                $this->Flash->success(__('The clase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clase could not be saved. Please, try again.'));
        }
        $usuario = $this->Clase->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('clase', 'usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clase id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clase = $this->Clase->get($id, [
            'contain' => ['Usuario']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clase = $this->Clase->patchEntity($clase, $this->request->getData());
            if ($this->Clase->save($clase)) {
                $this->Flash->success(__('The clase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clase could not be saved. Please, try again.'));
        }
        $usuario = $this->Clase->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('clase', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clase id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clase = $this->Clase->get($id);
        if ($this->Clase->delete($clase)) {
            $this->Flash->success(__('The clase has been deleted.'));
        } else {
            $this->Flash->error(__('The clase could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
