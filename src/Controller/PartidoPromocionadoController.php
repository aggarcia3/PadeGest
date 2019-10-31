<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PartidoPromocionado Controller
 *
 * @property \App\Model\Table\PartidoPromocionadoTable $PartidoPromocionado
 *
 * @method \App\Model\Entity\PartidoPromocionado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartidoPromocionadoController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $partidoPromocionado = $this->paginate($this->PartidoPromocionado);

        $this->set(compact('partidoPromocionado'));
    }

    /**
     * View method
     *
     * @param string|null $id Partido Promocionado id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partidoPromocionado = $this->PartidoPromocionado->get($id, [
            'contain' => ['Usuario']
        ]);

        $this->set('partidoPromocionado', $partidoPromocionado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partidoPromocionado = $this->PartidoPromocionado->newEntity();
        if ($this->request->is('post')) {
            $partidoPromocionado = $this->PartidoPromocionado->patchEntity($partidoPromocionado, $this->request->getData());
            if ($this->PartidoPromocionado->save($partidoPromocionado)) {
                $this->Flash->success(__('The partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The partido promocionado could not be saved. Please, try again.'));
        }
        $usuario = $this->PartidoPromocionado->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('partidoPromocionado', 'usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partidoPromocionado = $this->PartidoPromocionado->get($id, [
            'contain' => ['Usuario']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partidoPromocionado = $this->PartidoPromocionado->patchEntity($partidoPromocionado, $this->request->getData());
            if ($this->PartidoPromocionado->save($partidoPromocionado)) {
                $this->Flash->success(__('The partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The partido promocionado could not be saved. Please, try again.'));
        }
        $usuario = $this->PartidoPromocionado->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('partidoPromocionado', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partidoPromocionado = $this->PartidoPromocionado->get($id);
        if ($this->PartidoPromocionado->delete($partidoPromocionado)) {
            $this->Flash->success(__('The partido promocionado has been deleted.'));
        } else {
            $this->Flash->error(__('The partido promocionado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
