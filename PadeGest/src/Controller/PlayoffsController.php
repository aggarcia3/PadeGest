<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Playoffs Controller
 *
 * @property \App\Model\Table\PlayoffsTable $Playoffs
 *
 * @method \App\Model\Entity\Playoff[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayoffsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $playoffs = $this->paginate($this->Playoffs);

        $this->set(compact('playoffs'));
    }

    /**
     * View method
     *
     * @param string|null $id Playoff id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $playoff = $this->Playoffs->get($id, [
            'contain' => []
        ]);

        $this->set('playoff', $playoff);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $playoff = $this->Playoffs->newEntity();
        if ($this->request->is('post')) {
            $playoff = $this->Playoffs->patchEntity($playoff, $this->request->getData());
            if ($this->Playoffs->save($playoff)) {
                $this->Flash->success(__('The playoff has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playoff could not be saved. Please, try again.'));
        }
        $this->set(compact('playoff'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Playoff id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $playoff = $this->Playoffs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $playoff = $this->Playoffs->patchEntity($playoff, $this->request->getData());
            if ($this->Playoffs->save($playoff)) {
                $this->Flash->success(__('The playoff has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playoff could not be saved. Please, try again.'));
        }
        $this->set(compact('playoff'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Playoff id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $playoff = $this->Playoffs->get($id);
        if ($this->Playoffs->delete($playoff)) {
            $this->Flash->success(__('The playoff has been deleted.'));
        } else {
            $this->Flash->error(__('The playoff could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
