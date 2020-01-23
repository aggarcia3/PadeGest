<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

/**
 * Pago Controller
 *
 * @property \App\Model\Table\PagoTable $Pago
 *
 * @method \App\Model\Entity\Pago[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function isAuthorized($user)
    {
        return in_array($this->request->getParam('action'), ['add']) ||
            $user['rol'] === 'administrador';
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuario'],
        ];
        $pago = $this->paginate($this->Pago);

        $this->set(compact('pago'));
    }

    /**
     * View method
     *
     * @param string|null $id Pago id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pago = $this->Pago->get($id, [
            'contain' => ['Usuario'],
        ]);

        $this->set('pago', $pago);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();
        if(isset($data['esSocio'])){
            if($data['esSocio'] == 0){
                $user['esSocio'] = 0;
                $usuario2 = (new UsuarioController());
                $usuario2->hacerseSocio2($user['esSocio']);
                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
        }
        
        $pago = $this->Pago->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if($data['esSocio'] == 1){
                $usuario = TableRegistry::getTableLocator()->get('Usuario');
                $resultsIteratorObject2 = $usuario->find()->where(['id' => $this->Auth->user('id')])->all();

                foreach($resultsIteratorObject2 as $datos){
                    $user['esSocio'] = $datos['esSocio'];
                }

                if($user['esSocio'] == 1){
                    $this->Flash->error(__('Ya eres Socio'));

                    return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
                }else{
                    $user['esSocio'] = 1;
                    $usuario2 = (new UsuarioController());
                    $usuario2->hacerseSocio2($user['esSocio']);
                }

                unset($data['esSocio']);

            }

            $fecha_actual = FrozenTime::now();
            $data['fecha'] = $fecha_actual;
            $data['concepto'] = 'Hacerse Socio';
            $data['importe'] = 40;
            $data['usuario_id'] = $this->Auth->user('id');

            $pago = $this->Pago->patchEntity($pago, $data);
            if ($this->Pago->save($pago)) {

                $this->Flash->success(__('Ahora eres Socio'));

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('The pago could not be saved. Please, try again.'));
        }
        $usuario = $this->Pago->Usuario->find('list', ['limit' => 200]);
        $this->set(array('pago' => $pago, 'usuario' => $usuario, 'esSocio' => $data['esSocio']));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pago id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pago = $this->Pago->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pago = $this->Pago->patchEntity($pago, $this->request->getData());
            if ($this->Pago->save($pago)) {
                $this->Flash->success(__('The pago has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pago could not be saved. Please, try again.'));
        }
        $usuario = $this->Pago->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('pago', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pago id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pago = $this->Pago->get($id);
        if ($this->Pago->delete($pago)) {
            $this->Flash->success(__('The pago has been deleted.'));
        } else {
            $this->Flash->error(__('The pago could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
