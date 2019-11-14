<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Campeonato Controller
 *
 * @property \App\Model\Table\CampeonatoTable $Campeonato
 *
 * @method \App\Model\Entity\Campeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CampeonatoController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['view', 'index', 'inscribirse']) ||
               $user['rol'] === 'administrador';

    }

    public function inscribirse($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);

        $this->set('campeonato', $campeonato);
    }

    public function index()
    {
        $campeonato = $this->paginate($this->Campeonato);

        $this->set(compact('campeonato'));
    }

    /**
     * View method
     *
     * @param string|null $id Campeonato id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);

        $this->set('campeonato', $campeonato);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $campeonato = $this->Campeonato->newEntity();
        if ($this->request->is('post')) {
            $campeonato = $this->Campeonato->patchEntity($campeonato, $this->request->getData());
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campeonato could not be saved. Please, try again.'));
        }
        $this->set(compact('campeonato'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Campeonato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $campeonato = $this->Campeonato->patchEntity($campeonato, $this->request->getData());
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campeonato could not be saved. Please, try again.'));
        }
        $this->set(compact('campeonato'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Campeonato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $campeonato = $this->Campeonato->get($id);
        if ($this->Campeonato->delete($campeonato)) {
            $this->Flash->success(__('The campeonato has been deleted.'));
        } else {
            $this->Flash->error(__('The campeonato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
