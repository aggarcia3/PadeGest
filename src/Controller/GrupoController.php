<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grupo Controller
 *
 * @property \App\Model\Table\GrupoTable $Grupo
 *
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GrupoController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $grupo = $this->paginate($this->Grupo);

        $this->set(compact('grupo'));
    }

    /**
     * View method
     *
     * @param string|null $id Grupo id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);

        $this->set('grupo', $grupo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grupo = $this->Grupo->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupo->patchEntity($grupo, $this->request->getData());
            if ($this->Grupo->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }
        $this->set(compact('grupo'));
    }

    public function add2($var)
    {
        $grupo = $this->Grupo->newEntity();
        $grupo = $this->Grupo->patchEntity($grupo, $var);
        if ($this->Grupo->save($grupo)) {
            $this->Flash->success(__('The grupo has been saved.'));

            return $this->redirect(['action' => 'index']);
        }else{
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }    
    
        $this->set(compact('grupo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grupo = $this->Grupo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grupo = $this->Grupo->patchEntity($grupo, $this->request->getData());
            if ($this->Grupo->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }
        $this->set(compact('grupo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grupo = $this->Grupo->get($id);
        if ($this->Grupo->delete($grupo)) {
            $this->Flash->success(__('The grupo has been deleted.'));
        } else {
            $this->Flash->error(__('The grupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
