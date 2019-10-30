<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsuarioPartidoPromocionado Controller
 *
 * @property \App\Model\Table\UsuarioPartidoPromocionadoTable $UsuarioPartidoPromocionado
 *
 * @method \App\Model\Entity\UsuarioPartidoPromocionado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuarioPartidoPromocionadoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $usuarioPartidoPromocionado = $this->paginate($this->UsuarioPartidoPromocionado);

        $this->set(compact('usuarioPartidoPromocionado'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario Partido Promocionado id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->get($id, [
            'contain' => []
        ]);

        $this->set('usuarioPartidoPromocionado', $usuarioPartidoPromocionado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->newEntity();
        if ($this->request->is('post')) {
            $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->patchEntity($usuarioPartidoPromocionado, $this->request->getData());
            if ($this->UsuarioPartidoPromocionado->save($usuarioPartidoPromocionado)) {
                $this->Flash->success(__('The usuario partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario partido promocionado could not be saved. Please, try again.'));
        }
        $this->set(compact('usuarioPartidoPromocionado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->patchEntity($usuarioPartidoPromocionado, $this->request->getData());
            if ($this->UsuarioPartidoPromocionado->save($usuarioPartidoPromocionado)) {
                $this->Flash->success(__('The usuario partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario partido promocionado could not be saved. Please, try again.'));
        }
        $this->set(compact('usuarioPartidoPromocionado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->get($id);
        if ($this->UsuarioPartidoPromocionado->delete($usuarioPartidoPromocionado)) {
            $this->Flash->success(__('The usuario partido promocionado has been deleted.'));
        } else {
            $this->Flash->error(__('The usuario partido promocionado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
