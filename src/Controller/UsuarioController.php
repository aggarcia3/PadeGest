<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

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
     * {@inheritDoc}
     */
    public function initialize()
    {
        parent::initialize();

        $this->Auth->allow(['register', 'login']);
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
        // Los usuarios no administradores solo pueden ver su perfil, editarlo
        // y desconectarse
        return in_array($this->getRequest()->getParam('action'), ['view', 'edit', 'logout']) ||
               $user['rol'] === 'administrador';
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $usuario = $this->paginate($this->Usuario);
        $this->set('usuarios', $usuario);
    }

    /**
     * Inicia sesión
     *
     * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
     */
    public function login()
    {
        if ($this->Auth->user() !== null) {
            $this->Flash->success(__('Ya estás conectado como {0}.', $this->Auth->user('username')));

            return $this->redirect($this->referer(['controller' => 'Pages', 'action' => 'display', 'index'], true));
        } elseif ($this->getRequest()->is('post')) {
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
     * Cierra sesión
     *
     * @return \Cake\Http\Response Redirects to index.
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
        $usuario = $this->Usuario->newEntity();

        if ($this->getRequest()->is('post')) {
            /** @var array */
            $data = $this->getRequest()->getData();

            $data['rol'] = 'deportista';
            $data['esSocio'] = '0';
            if (isset($data['password']) && is_string($data['password'])) {
                if (empty($data['password'])) {
                    unset($data['password']);
                } else {
                    $data['password'] = $this->hashPassword($data['password']);
                }
            }

            $usuario = $this->Usuario->patchEntity($usuario, $data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__("¡Bienvenido a PadeGest, {0}!", $usuario->nombre_completo));
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
        $usuario = $this->Usuario->newEntity();

        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();

            if (isset($data['password']) && is_string($data['password'])) {
                if (empty($data['password'])) {
                    unset($data['password']);
                } else {
                    $data['password'] = $this->hashPassword($data['password']);
                }
            }

            $usuario = $this->Usuario->patchEntity($usuario, $data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__('El usuario ha sido creado con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ha ocurrido un error al crear el usuario. Por favor, inténtalo de nuevo.'));
        }

        $this->set(compact('usuario'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on error, renders view otherwise.
     */
    public function view($id = null)
    {
        $getOptions = [];

        // Los usuarios no administradores solo ven su perfil
        if ($this->Auth->user('rol') !== 'administrador') {
            $getOptions += [
                'conditions' => ['id =' => $this->Auth->user('id')]
            ];
        }

        try {
            $usuario = $this->Usuario->get($id, $getOptions);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('El {0} especificado no existe o no tienes permiso para verlo.', __('usuario')));

            return $this->redirect($this->referer(['controller' => 'Pages', 'action' => 'display', 'index'], true));
        }

        $this->set(compact('usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects on edit, renders view otherwise.
     */
    public function edit($id = null)
    {
        $getOptions = [];

        // Los usuarios no administradores solo pueden editar su perfil
        if ($this->Auth->user('rol') !== 'administrador') {
            $getOptions += [
                'conditions' => ['id =' => $this->Auth->user('id')]
            ];
        }

        try {
            $usuario = $this->Usuario->get($id, $getOptions);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('El {0} especificado no existe o no tienes permiso para verlo.', __('usuario')));

            return $this->redirect($this->referer(['controller' => 'Pages', 'action' => 'display', 'index'], true));
        }

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();

            if (empty($data['password'])) {
                $data['password'] = $usuario->password;
            } else {
                $data['password'] = $this->hashPassword($data['password']);
            }

            $usuario = $this->Usuario->patchEntity($usuario, $data);
            if ($this->Usuario->save($usuario)) {
                $this->Flash->success(__($this->Auth->user('id') == $usuario->id ? 'Has editado tu perfil.' : 'El usuario ha sido editado.'));

                // Actualizar los datos de usuario guardados en la sesión,
                // para que los cambios en p. ej. el nombre de usuario se visualicen
                // inmediatamente
                if ($this->Auth->user('id') == $usuario->id) {
                    $this->Auth->setUser($usuario);
                }

                if ($this->Auth->user('rol') !== 'administrador') {
                    return $this->redirect(['action' => 'view', $usuario->id]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }

        $this->set(compact('usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response Redirecciona al índice.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);

        try {
            $usuario = $this->Usuario->get($id);

            if ($usuario->id == $this->Auth->user('id')) {
                $this->Flash->error(__('No puedes borrar tu propio usuario.'));
            } else {
                if ($this->Usuario->delete($usuario)) {
                    $this->Flash->success(__('{0} borrado con éxito.', __('Usuario')));
                } else {
                    $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
                }
            }
        } catch (RecordNotFoundException $_) {
            // Ignorar el error
            $this->Flash->success(__('{0} borrado con éxito.', __('Usuario')));
        }

        return $this->redirect(['action' => 'index']);
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
