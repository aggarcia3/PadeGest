<?php
namespace App\Controller;

use App\Controller\AppController;

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
     * Código de inicialización del controlador
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->Auth->allow(['login', 'register']);
    }

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
    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['index', 'logout']) ||
               $this->Auth->user('rol') === 'administrador';
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        // Renderizar vista
    }

    /**
     * Lista todos los usuarios en el sistema
     *
     * @return void
     */
    public function listar()
    {
        $usuario = $this->paginate($this->Usuario);

        $this->set('usuario', $usuario);
    }

    /**
     * Inicia sesión
     *
     * @return \Cake\Http\Response|null
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

    /**
     * Cierra la sesión
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Registra a un usuario
     *
     * @return \Cake\Http\Response|null
     */
    public function register()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['rol'] = 'deportista';
            $data['password'] = $this->hashPassword($data['password']);

            $usuario = $this->Usuario->newEntity($data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__("¡Bienvenido a PadeGest, {0}!", $usuario->nombre));
                $this->Auth->setUser($usuario);

                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Ha ocurrido un error al crear el nuevo usuario. Por favor, inténtalo de nuevo.'));
            }
        } else {
            $usuario = $this->Usuario->newEntity();
        }

        $this->set(compact('usuario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['password'] = $this->hashPassword($data['password']);

            $usuario = $this->Usuario->newEntity($data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido creado con éxito.'));

                return $this->redirect(['action' => 'listar']);
            }
            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        } else {
            $usuario = $this->Usuario->newEntity();
        }

        $this->set(compact('usuario'));
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
            $data = $this->request->getData();
            $data['password'] = is_string($data['password']) ? $this->hashPassword($data['password']) : $data['password'];

            $usuario = $this->Usuario->patchEntity($usuario, $this->request->getData());
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido modificado correctamente.'));

                return $this->redirect(['action' => 'listar']);
            } else {
                $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
            }
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
            $this->Flash->success(__('El usuario ha sido borrado con éxito.'));
        } else {
            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }

        return $this->redirect(['action' => 'listar']);
    }

    /**
     * Calcula el resumen de una contraseña, listo para asignar al correspondiente atributo
     * del modelo de datos del usuario.
     *
     * @param string $password La contraseña de la que calcular su resumen.
     * @return string El resumen de la contraseña.
     */
    private function hashPassword($password)
    {
        return $this->Auth->getAuthenticate('Form')->passwordHasher()->hash($password);
    }
}
