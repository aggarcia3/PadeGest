<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Enfrentamiento Controller
 *
 * @property \App\Model\Table\EnfrentamientoTable $Enfrentamiento
 *
 * @method \App\Model\Entity\Enfrentamiento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnfrentamientoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $enfrentamiento = $this->paginate($this->Enfrentamiento);

        $this->set(compact('enfrentamiento'));
    }

    /**
     * View method
     *
     * @param string|null $id Enfrentamiento id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enfrentamiento = $this->Enfrentamiento->get($id, [
            'contain' => ['Pareja']
        ]);

        $this->set('enfrentamiento', $enfrentamiento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enfrentamiento = $this->Enfrentamiento->newEntity();
        if ($this->request->is('post')) {
            $enfrentamiento = $this->Enfrentamiento->patchEntity($enfrentamiento, $this->request->getData());
            if ($this->Enfrentamiento->save($enfrentamiento)) {
                $this->Flash->success(__('The enfrentamiento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enfrentamiento could not be saved. Please, try again.'));
        }
        $pareja = $this->Enfrentamiento->Pareja->find('list', ['limit' => 200]);
        $this->set(compact('enfrentamiento', 'pareja'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Enfrentamiento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enfrentamiento = $this->Enfrentamiento->get($id, [
            'contain' => ['Pareja']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enfrentamiento = $this->Enfrentamiento->patchEntity($enfrentamiento, $this->request->getData());
            if ($this->Enfrentamiento->save($enfrentamiento)) {
                $this->Flash->success(__('The enfrentamiento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enfrentamiento could not be saved. Please, try again.'));
        }
        $pareja = $this->Enfrentamiento->Pareja->find('list', ['limit' => 200]);
        $this->set(compact('enfrentamiento', 'pareja'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enfrentamiento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enfrentamiento = $this->Enfrentamiento->get($id);
        if ($this->Enfrentamiento->delete($enfrentamiento)) {
            $this->Flash->success(__('The enfrentamiento has been deleted.'));
        } else {
            $this->Flash->error(__('The enfrentamiento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
