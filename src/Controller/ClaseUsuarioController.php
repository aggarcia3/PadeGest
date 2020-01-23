<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClaseUsuario Controller
 *
 * @property \App\Model\Table\ClaseUsuarioTable $ClaseUsuario
 *
 * @method \App\Model\Entity\ClaseUsuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClaseUsuarioController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clase', 'Usuario'],
        ];
        $claseUsuario = $this->paginate($this->ClaseUsuario);

        $this->set(compact('claseUsuario'));
    }

    /**
     * View method
     *
     * @param string|null $id Clase Usuario id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $claseUsuario = $this->ClaseUsuario->get($id, [
            'contain' => ['Clase', 'Usuario'],
        ]);

        $this->set('claseUsuario', $claseUsuario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $claseUsuario = $this->ClaseUsuario->newEntity();
        if ($this->request->is('post')) {
            $claseUsuario = $this->ClaseUsuario->patchEntity($claseUsuario, $this->request->getData());
            if ($this->ClaseUsuario->save($claseUsuario)) {
                $this->Flash->success(__('The clase usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clase usuario could not be saved. Please, try again.'));
        }
        $clase = $this->ClaseUsuario->Clase->find('list', ['limit' => 200]);
        $usuario = $this->ClaseUsuario->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('claseUsuario', 'clase', 'usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Clase Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $claseUsuario = $this->ClaseUsuario->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $claseUsuario = $this->ClaseUsuario->patchEntity($claseUsuario, $this->request->getData());
            if ($this->ClaseUsuario->save($claseUsuario)) {
                $this->Flash->success(__('The clase usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clase usuario could not be saved. Please, try again.'));
        }
        $clase = $this->ClaseUsuario->Clase->find('list', ['limit' => 200]);
        $usuario = $this->ClaseUsuario->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('claseUsuario', 'clase', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Clase Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $claseUsuario = $this->ClaseUsuario->get($id);
        if ($this->ClaseUsuario->delete($claseUsuario)) {
            $this->Flash->success(__('The clase usuario has been deleted.'));
        } else {
            $this->Flash->error(__('The clase usuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
