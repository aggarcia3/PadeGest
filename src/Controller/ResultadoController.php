<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Resultado Controller
 *
 * @property \App\Model\Table\ResultadoTable $Resultado
 *
 * @method \App\Model\Entity\Resultado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResultadoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $resultado = $this->paginate($this->Resultado);

        $this->set(compact('resultado'));
    }

    /**
     * View method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultado = $this->Resultado->get($id, [
            'contain' => []
        ]);

        $this->set('resultado', $resultado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resultado = $this->Resultado->newEntity();
        if ($this->request->is('post')) {
            $resultado = $this->Resultado->patchEntity($resultado, $this->request->getData());
            if ($this->Resultado->save($resultado)) {
                $this->Flash->success(__('The resultado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resultado could not be saved. Please, try again.'));
        }
        $this->set(compact('resultado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultado = $this->Resultado->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resultado = $this->Resultado->patchEntity($resultado, $this->request->getData());
            if ($this->Resultado->save($resultado)) {
                $this->Flash->success(__('The resultado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resultado could not be saved. Please, try again.'));
        }
        $this->set(compact('resultado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultado = $this->Resultado->get($id);
        if ($this->Resultado->delete($resultado)) {
            $this->Flash->success(__('The resultado has been deleted.'));
        } else {
            $this->Flash->error(__('The resultado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}