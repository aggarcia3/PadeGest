<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;
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
    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['register','index', 'logout', 'edit']) ||
               $user['rol'] === 'administrador';

    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Reserva']
        ];
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
            'contain' => ['Reserva', 'Pareja', 'Resultado']
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
        $reserva = $this->Enfrentamiento->Reserva->find('list', ['limit' => 200]);
        $pareja = $this->Enfrentamiento->Pareja->find('list', ['limit' => 200]);
        $this->set(compact('enfrentamiento', 'reserva', 'pareja'));
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
        $reserva = $this->Enfrentamiento->Reserva->find('list', ['limit' => 200]);
        $pareja = $this->Enfrentamiento->Pareja->find('list', ['limit' => 200]);
        $this->set(compact('enfrentamiento', 'reserva', 'pareja'));
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
