<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Usuario Controller
 *
 * @property \App\Model\Table\UsuarioTable $Usuario
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuarioController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */

    public function index(){

    }

    public function listar()
    {
        $usuario = $this->paginate($this->Usuario);
        $this->set([ $usuario ]);
    }

    /**
     * Define las funcionalidades permitidas a usuarios no autenticados
     *
     * @param Event $event El evento ocurrido
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('register', 'logout', 'login');
    }

    /**
     * Inicia sesión
     *
     * @return void
     */
    public function login()
    {
        if($this->Auth->user('id')){
            $this->Flash->error(__('Ya estas registrado'));
            return $this->redirect($this->Auth->redirectUrl());
        }else{
            if ($this->request->is('post')) {
                $usuario = $this->Auth->identify();
                if ($usuario) {
                    $this->Auth->setUser($usuario);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Usuario o Contraseña invalidos, inténtalo de nuevo'));
            }
        }    
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Registra a un usuario
     *
     * @return void
     */
    public function register()
    {
        $usuario = $this->Usuario->newEntity();
        $this->viewBuilder();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['rol'] = 'deportista';
            $usuario = $this->Usuario->patchEntity($usuario, $data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('El usuario ha sigo registrado'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('El usuario no se ha podido registrar, inténtalo de nuevo'));
        }
    }

    public function add()
    {
        $usuario = $this->Usuario->newEntity();
        $this->viewBuilder();
        
        if ($this->request->is('post')) {
            $usuario = $this->Usuario->patchEntity($usuario, $this->request->getData());
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('El usuario ha sigo registrado'));
                return $this->redirect(['action' => 'listar']);
            }
            $this->Flash->error(__('El usuario no se ha podido registrar, inténtalo de nuevo'));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuario->get($id);

        $this->set('usuario', $usuario);
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuario = $this->Usuario->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuario->patchEntity($usuario, $this->request->getData());
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('The usuario has been saved.'));

                return $this->redirect(['action' => 'listar']);
            }
            $this->Flash->error(__('The usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuario->get($id);
        if ($this->Usuario->delete($usuario)) {
            $this->Flash->success(__('The usuario has been deleted.'));
        } else {
            $this->Flash->error(__('The usuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'listar']);
    }
}
