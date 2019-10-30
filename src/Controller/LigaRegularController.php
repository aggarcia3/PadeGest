<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LigaRegular Controller
 *
 * @property \App\Model\Table\LigaRegularTable $LigaRegular
 *
 * @method \App\Model\Entity\LigaRegular[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LigaRegularController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $ligaRegular = $this->paginate($this->LigaRegular);

        $this->set(compact('ligaRegular'));
    }

    /**
     * View method
     *
     * @param string|null $id Liga Regular id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ligaRegular = $this->LigaRegular->get($id, [
            'contain' => []
        ]);

        $this->set('ligaRegular', $ligaRegular);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ligaRegular = $this->LigaRegular->newEntity();
        if ($this->request->is('post')) {
            $ligaRegular = $this->LigaRegular->patchEntity($ligaRegular, $this->request->getData());
            if ($this->LigaRegular->save($ligaRegular)) {
                $this->Flash->success(__('The liga regular has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The liga regular could not be saved. Please, try again.'));
        }
        $this->set(compact('ligaRegular'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Liga Regular id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ligaRegular = $this->LigaRegular->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ligaRegular = $this->LigaRegular->patchEntity($ligaRegular, $this->request->getData());
            if ($this->LigaRegular->save($ligaRegular)) {
                $this->Flash->success(__('The liga regular has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The liga regular could not be saved. Please, try again.'));
        }
        $this->set(compact('ligaRegular'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Liga Regular id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ligaRegular = $this->LigaRegular->get($id);
        if ($this->LigaRegular->delete($ligaRegular)) {
            $this->Flash->success(__('The liga regular has been deleted.'));
        } else {
            $this->Flash->error(__('The liga regular could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}