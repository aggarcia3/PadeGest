<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ReservaTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Reserva Controller
 *
 * @property \App\Model\Table\ReservaTable $Reserva
 *
 * @method \App\Model\Entity\Reserva[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservaController extends AppController
{
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
        return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $paginationOptions = [
            'contain' => ['Pista', 'Usuario', 'Enfrentamiento', 'PartidoPromocionado'],
            'order' => [
                'Reserva.fechaInicio' => 'desc'
            ]
        ];

        // Los usuarios no administradores solo ven sus reservas
        if ($this->Auth->user('rol') !== 'administrador') {
            $paginationOptions += [
                'conditions' => ['usuario_id =' => $this->Auth->user('id')]
            ];
        }

        $this->paginate = $paginationOptions;
        $reserva = $this->paginate($this->Reserva);

        $this->set(compact('reserva'));
    }

    /**
     * View method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null
     */
    public function view($id = null)
    {
        $getOptions = [
            'contain' => ['Pista', 'Usuario', 'Enfrentamiento', 'PartidoPromocionado']
        ];

        // Los usuarios no administradores solo ven sus reservas
        if ($this->Auth->user('rol') !== 'administrador') {
            $getOptions += [
                'conditions' => ['usuario_id =' => $this->Auth->user('id')]
            ];
        }

        try {
            $reserva = $this->Reserva->get($id, $getOptions);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe o no tienes permiso para verla.', __('reserva')));

            $this->viewBuilder()->setTemplate('index');

            return $this->index();
        }

        $this->set(compact('reserva'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $datos = $this->request->getData();

            // Convertir timestamp UTC a objeto de tipo fecha en franja
            // horaria local. El método usado puede devolver falso
            $datos['fechaInicio'] = FrozenTime::now()->setTimestamp($datos['fechaInicio']);

            // Los usuarios solo pueden crear reservas a su nombre
            if ($this->Auth->user('rol') !== 'administrador') {
                $datos['usuario_id'] = $this->Auth->user('id');
            }

            // El administrador puede indicar, bajo su propia responsabilidad,
            // una pista concreta
            if ($this->Auth->user('rol') === 'administrador' && is_numeric($datos['pista_id'])) {
                $pistaLibre = $this->Reserva->Pista->find()
                    ->where(['id' => $datos['pista_id']])
                    ->first();
            } else {
                $pistaLibre = ReservaTable::pistaLibre($datos['fechaInicio']);
            }

            if ($pistaLibre instanceof Entity) {
                $datos['pista_id'] = $pistaLibre->id;

                $reserva = $this->Reserva->newEntity($datos);

                if ($this->Reserva->save($reserva)) {
                    $this->Flash->success(__('Reservada la pista número {0} a fecha {1}.', $reserva->pista_id, $reserva->fechaInicio));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
            } else {
                $reserva = $this->Reserva->newEntity($datos);

                $this->Flash->error(__('No hay una pista disponible en la fecha seleccionada. Por favor, escoge otra fecha.'));
            }
        } else {
            $reserva = $this->Reserva->newEntity();
        }

        $this->set('hoy', FrozenTime::now());
        $this->set(compact('reserva'));

        // Los administradores tienen acceso a más información
        if ($this->Auth->user('rol') === 'administrador') {
            $usuario = $this->Reserva->Usuario
                ->find('list', [
                    'valueField' => 'username',
                    'groupField' => 'estado_asociado'
                ])
                ->where([
                    'rol <>' => 'administrador'
                ])->orderAsc('username');

            $pista = $this->Reserva->Pista->find('list');

            $this->set(compact('usuario', 'pista'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     */
    public function edit($id = null)
    {
        $getOptions = [];

        // Los usuarios no administradores solo editan sus reservas
        if ($this->Auth->user('rol') !== 'administrador') {
            $getOptions += [
                'conditions' => ['usuario_id =' => $this->Auth->user('id')]
            ];
        }

        try {
            $reserva = $this->Reserva->get($id, $getOptions);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe, o no tienes permiso para editarla.', __('reserva')));

            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $datos = $this->request->getData();

            // Convertir fecha en timestamp a objeto fecha
            $datos['fechaInicio'] = FrozenTime::now()->setTimestamp($datos['fechaInicio']);

            $reserva = $this->Reserva->patchEntity($reserva, $datos);

            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('{0} editada con éxito.', [__('Reserva')]));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }

        $this->set('hoy', FrozenTime::now());
        $this->set(compact('reserva'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        try {
            $reserva = $this->Reserva->get($id);

            // Si el usuario no es administrador, solo puede borrar las reservas
            // a su nombre
            if ((
                    $this->Auth->user('rol') === 'administrador' ||
                    $reserva->usuario_id === $this->Auth->user('id')
                ) && $this->Reserva->delete($reserva)
            ) {
                $this->Flash->success(__('{0} borrada con éxito.', __('Reserva')));
            } else {
                $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
            }
        } catch (RecordNotFoundException $_) {
            // Ignorar el error
            $this->Flash->success(__('{0} borrada con éxito.', __('Reserva')));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Muestra un mensaje de error indicando que Javascript no está disponible,
     * y redirige al usuario al índice. Esta acción es invocada por el widget de
     * Flatpickr si el usuario no tiene Javascript activado.
     *
     * @return \Cake\Http\Response Redirecciona al usuario a la acción por defecto del
     * controlador.
     */
    public function errorJs()
    {
        $this->request->allowMethod('get');

        $this->Flash->error(__('Javascript no está activado en tu navegador, y es necesario para acceder a esta funcionalidad. Por favor, actívalo y vuelve a intentarlo.'));

        return $this->redirect(['action' => 'index']);
    }
}
