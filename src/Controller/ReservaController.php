<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\PistaTable;
use App\Model\Table\ReservaTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\BadRequestException;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

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
        // Permitir el uso de todas las acciones, excepto franjasFecha, por todos los usuarios.
        // El uso de franjasFecha solo se permite si la solicitud es Ajax
        return $this->getRequest()->getParam('action') !== 'franjasFecha' || $this->getRequest()->is('ajax');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $paginationOptions = [
            'contain' => ['Pista', 'Usuario', 'Enfrentamiento', 'PartidoPromocionado', 'Clase'],
            'order' => [
                'Reserva.fechaInicio' => 'desc',
            ],
        ];
        // Los usuarios no administradores solo ven sus reservas
        if ($this->Auth->user('rol') !== 'administrador') {
            $paginationOptions += [
                'conditions' => ['usuario_id =' => $this->Auth->user('id')],
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
     * @return void
     */
    public function view($id = null)
    {
        $getOptions = [
            'contain' => ['Pista', 'Usuario', 'Enfrentamiento', 'PartidoPromocionado', 'Clase'],
        ];
        // Los usuarios no administradores solo ven sus reservas
        if ($this->Auth->user('rol') !== 'administrador') {
            $getOptions += [
                'conditions' => ['usuario_id =' => $this->Auth->user('id')],
            ];
        }
        try {
            $reserva = $this->Reserva->get($id, $getOptions);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe o no tienes permiso para verla.', __('reserva')));
            $this->viewBuilder()->setTemplate('index');
            $this->index();
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
        if ($this->getRequest()->is('post')) {
            $datos = $this->getRequest()->getData();
            // Convertir timestamp de fecha y franja a objeto de tipo fecha.
            // La fecha final se calcula a partir del número de franja y la
            // duración de cada reserva
            $franjas = ReservaTable::franjasReservas();
            if (
                isset($datos['fechaInicio']) &&
                isset($datos['franja']) &&
                is_numeric($datos['fechaInicio']) &&
                is_numeric($datos['franja']) &&
                isset($franjas[$datos['franja']])
            ) {
                $fecha = FrozenTime::now()
                    ->setTimestamp($datos['fechaInicio']);
                $datos['fechaInicio'] = $fecha->setTime(
                    $franjas[$datos['franja']]->hour,
                    $franjas[$datos['franja']]->minute
                );
            } else {
                $datos['fechaInicio'] = null;
            }

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
                $tablaPista = TableRegistry::getTableLocator()->get('Pista');
                assert($tablaPista instanceof PistaTable);
                $pistaLibre = $tablaPista->libreEn($datos['fechaInicio']);
            }
            if ($pistaLibre instanceof Entity) {
                $datos['pista_id'] = $pistaLibre->id;
                // Establecer AuthComponent para realizar las validaciones oportunas
                $tablaReserva = TableRegistry::getTableLocator()->get('Reserva');
                assert($tablaReserva instanceof ReservaTable);
                $tablaReserva->setAuth($this->Auth);

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
                    'groupField' => 'estado_asociado',
                ])
                ->where([
                    'rol <>' => 'administrador',
                ])->orderAsc('username');
            $pista = $this->Reserva->Pista->find('list');
            $this->set(compact('usuario', 'pista'));
        }
    }

    public function add2($datos)
    {
        $datos['usuario_id'] = null;

        $reserva = $this->Reserva->newEntity($datos);
        if ($this->Reserva->save($reserva)) {
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
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
        $this->getRequest()->allowMethod(['post', 'delete']);
        try {
            $reserva = $this->Reserva->get($id);
            // Si el usuario no es administrador, solo puede borrar las reservas
            // a su nombre
            if (
                (
                    $this->Auth->user('rol') === 'administrador' ||
                    $reserva->usuario_id === $this->Auth->user('id')
                ) && $this->Reserva->delete($reserva)
            ) {
                $this->Flash->success(
                    __(
                        '{0} {1} con éxito.',
                        __('Reserva'),
                        $this->Auth->user('rol') === 'administrador' ? __('borrada') : __('cancelada')
                    )
                );
            } else {
                $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
            }
        } catch (RecordNotFoundException $_) {
            // Ignorar el error
            $this->Flash->success(
                __(
                    '{0} {1} con éxito.',
                    __('Reserva'),
                    $this->Auth->user('rol') === 'administrador' ? __('borrada') : __('cancelada')
                )
            );
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Obtiene las franjas horarias disponibles y ocupadas para una fecha dada.
     *
     * @return void Renderiza la vista.
     */
    public function franjasFecha()
    {
        $this->getRequest()->allowMethod('get');
        $timestamp = $this->getRequest()->getQueryParams()['fecha'];
        if (!is_numeric($timestamp) || !is_int($timestamp + 0)) {
            throw new BadRequestException();
        }
        $dia = FrozenTime::now()->setTimestamp($timestamp / 1000);
        if ($dia === false) {
            throw new BadRequestException();
        }
        $this->viewBuilder()->setClassName('Json');
        $tablaPistas = TableRegistry::getTableLocator()->get('Pista');
        assert($tablaPistas instanceof PistaTable);
        $franjas = ReservaTable::franjasReservas();
        foreach ($franjas as &$franja) {
            $franja = [
                $franja->format('H:i'),
                $franja->add(ReservaTable::getDuracionReservas())->format('H:i'),
                $tablaPistas->libreEn($dia->setTime($franja->hour, $franja->minute)) !== null,
            ];
        }
        $this->set(compact('franjas'));
        $this->set('_serialize', ['franjas']);
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
        $this->getRequest()->allowMethod('get');
        $this->Flash->error(__('Javascript no está activado en tu navegador, y es necesario para acceder a esta funcionalidad. Por favor, actívalo y vuelve a intentarlo.'));

        return $this->redirect(['action' => 'index']);
    }
}
