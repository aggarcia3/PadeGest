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



    /**
     * Comprueba que el usuario conectado tenga los privilegios suficientes para interactuar
     * con este controlador. Este método no se invoca para usuarios no conectados: en ese caso,
     * las restricciones por defecto especificadas con el método allow de AuthComponent se aplican
     * exclusivamente.
     *
     * @param array|\ArrayAccess $user El usuario conectado.
     * @return bool Verdadero si se le debe de conceder acceso a la acción al usuario, falso en
     * caso contrario.
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('index');
        $this->Auth->allow('register');
        $this->Auth->allow('login');
        $this->Auth->allow('logout');
    }

    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['register','index', 'logout', 'edit']) ||
               $user['rol'] === 'administrador';

    }

    
    public function index(){

    }

    public function listar()
    {

        $usuario = $this->paginate($this->Usuario);
        $this->set('usuario', $usuario);

    }


    /**
     * Inicia sesión
     *
     * @return void
     */
    public function login()
    {
        if ($this->Auth->user() !== null) {
            $this->Flash->success(__('Ya estás conectado como {0}.', $this->Auth->user('username')));
            $this->redirect($this->referer(['controller' => $this->getName(), 'action' => 'index'], true));
        } elseif ($this->request->is('post')) {
            $usuario = $this->Auth->identify();
            if ($usuario) {
                $this->Auth->setUser($usuario);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Alguna credencial es incorrecta. Por favor, revisa que no hayas escrito algo mal e inténtalo de nuevo.'));
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
            $data['esSocio'] = '0';
            $data['password'] = $this->hashPassword($data['password']);
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
        $var = $usuario->password;
        $usuario->__set('password', '');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if($data['password'] == ''){
                $data['password'] = $var;
            }else{
                $data['password'] = $this->hashPassword($data['password']);
            }
            $usuario = $this->Usuario->patchEntity($usuario, $data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('The usuario has been saved.'));

                return $this->redirect(['action' => 'listar']);
            }
            $this->Flash->error(__('The usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('usuario'));
    }
    public function hacerseSocio($id=null)
    {
        $usuario=$this->Usuario->get($this->Auth->user('id')); 
        if($this->request->is(['patch','post','put'])){
            $usuario = $this->Usuario->patchEntity($usuario, $this->request->getData());
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('Estado de socio cambiado'));
                return $this->redirect(['action'=>'listar']);
            }
            $this->Flash->error(__('Ha habido un error, intentalo de nuevo'));
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

    private function hashPassword($password)
    {
        return $this->Auth->getAuthenticate('Form')->passwordHasher()->hash($password);
    }
}
