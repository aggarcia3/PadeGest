<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CategoriaNivel Controller
 *
 * @property \App\Model\Table\CategoriaNivelTable $CategoriaNivel
 *
 * @method \App\Model\Entity\CategoriaNivel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriaNivelController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $categoriaNivel = $this->paginate($this->CategoriaNivel);

        $this->set(compact('categoriaNivel'));
    }

    /**
     * View method
     *
     * @param string|null $id Categoria Nivel id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoriaNivel = $this->CategoriaNivel->get($id, [
            'contain' => []
        ]);

        $this->set('categoriaNivel', $categoriaNivel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoriaNivel = $this->CategoriaNivel->newEntity();
        if ($this->request->is('post')) {
            $categoriaNivel = $this->CategoriaNivel->patchEntity($categoriaNivel, $this->request->getData());
            if ($this->CategoriaNivel->save($categoriaNivel)) {
                $this->Flash->success(__('The categoria nivel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categoria nivel could not be saved. Please, try again.'));
        }
        $this->set(compact('categoriaNivel'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria Nivel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoriaNivel = $this->CategoriaNivel->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriaNivel = $this->CategoriaNivel->patchEntity($categoriaNivel, $this->request->getData());
            if ($this->CategoriaNivel->save($categoriaNivel)) {
                $this->Flash->success(__('The categoria nivel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categoria nivel could not be saved. Please, try again.'));
        }
        $this->set(compact('categoriaNivel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categoria Nivel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriaNivel = $this->CategoriaNivel->get($id);
        if ($this->CategoriaNivel->delete($categoriaNivel)) {
            $this->Flash->success(__('The categoria nivel has been deleted.'));
        } else {
            $this->Flash->error(__('The categoria nivel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
