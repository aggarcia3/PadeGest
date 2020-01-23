<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Clase Controller
 *
 * @property \App\Model\Table\ClaseTable $Clase
 *
 * @method \App\Model\Entity\Clase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClaseController extends AppController
{
    /**
     * Comprueba si el usuario está autorizado a ejecutar el método correspondiente del controlador.
     *
     * @param mixed $user El usuario a comprobar.
     * @return boolean Verdadero si está autorizado, falso en otro caso.
     */
    public function isAuthorized($user)
    {
        $accion = $this->getRequest()->getParam('action');

        $esAdmin = $user['rol'] === 'administrador';
        $esAdminOEntrenador = $esAdmin || $user['rol'] === 'entrenador';
        $esDeportista = !$esAdmin && !$esAdminOEntrenador;

        // Acciones del controlador disponibles solo para entrenadores
        // o administradores
        $debeSerAdminOEntrenador = false;
        switch ($accion) {
            case 'view':
            case 'add':
            case 'delete':
            case 'mensaje':
                $debeSerAdminOEntrenador = true;
                break;
        }

        // Acciones del controlador solo disponibles para deportistas
        $soloPuedeSerDeportista = false;
        switch ($accion) {
            case 'inscribirse':
                $soloPuedeSerDeportista = true;
                break;
        }

        return ($esDeportista && !$debeSerAdminOEntrenador) || (!$esDeportista && !$soloPuedeSerDeportista);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $objetoConsulta = $this->Clase;

        // Los entrenadores visualizan solo sus clases
        if ($this->Auth->user('rol') === 'entrenador') {
            $objetoConsulta = $this->Clase->find()
                ->where(['entrenador_id' => $this->Auth->user('id')]);
        }

        $clase = $this->paginate($objetoConsulta, [
            'order' => [
                'Clase.fechaFinInscripcion' => 'desc',
            ],
            'contain' => ['Usuario'], // Necesario para deportistas
        ]);

        $this->set(compact('clase'));
    }

    /**
     * View method
     *
     * @param string|null $id Clase id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $clase = $this->Clase->get($id, [
                'contain' => ['Usuario', 'Reserva'],
            ]);

            // Los entrenadores no pueden ver clases de otros entrenadores
            if ($this->Auth->user('rol') === 'entrenador' && $clase->entrenador_id != $this->Auth->user('id')) {
                throw new RecordNotFoundException('');
            }

            $this->set('clase', $clase);
        } catch (RecordNotFoundException $exc) {
            $this->Flash->error(__('La clase especificada no existe o no tienes permisos para verla.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$usuarios = TableRegistry::getTableLocator()->get('Usuario');
       // $usuario = $usuarios->find()->where(['username' => ''])->all();
       $data = $this->request->getData();
       $usuarios = TableRegistry::getTableLocator()->get('Usuario');
        $usuario = $usuarios->find()->select(['username'])->where(['rol' => 'entrenador'])->all();
        $arrayUsuarios = array();
        $i = 0;
        foreach($usuario as $usuario){
            $arrayUsuarios[$i++] = $usuario['username'];
        }

        $usuarios = TableRegistry::getTableLocator()->get('Usuario');
        $usuarioDefinitivo = $usuarios->find()->where(['username' => $arrayUsuarios[$data['usuario']]])->all();
        foreach($usuarioDefinitivo as $usuario){
            $data['entrenador_id'] = $usuario['id'];
        }
        unset($data['usuario']);

        debug($data);

        $clase = $this->Clase->newEntity();
        if ($this->request->is('post')) {
            $clase = $this->Clase->patchEntity($clase, $data);
            if ($this->Clase->save($clase)) {
                $this->Flash->success(__('The clase has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The clase could not be saved. Please, try again.'));
        }
        $usuarios = TableRegistry::getTableLocator()->get('Usuario');
        $usuario = $usuarios->find()->select(['username'])->where(['rol' => 'entrenador'])->all();
        $arrayUsuarios = array();
        $i = 0;
        foreach($usuario as $usuario){
            $arrayUsuarios[$i++] = $usuario['username'];
        }
        $this->set(['clase' => $clase, 'usuario' => $arrayUsuarios]);
    }

    /**
     * Mensaje method
     *
     * @return \Cake\Http\Response|null Redirects on successful message, renders view otherwise.
     */
    public function mensaje($idClase = null, $idUsuario = null)
    {
        if (
            $this->request->is('post') &&
            is_numeric($idClase) && is_numeric($idUsuario) &&
            $this->request->getData()['texto'] !== null
        ) {
            try {
                $clase = $this->Clase->get($idClase);
                $esAlumno = TableRegistry::getTableLocator()->get('ClaseUsuario')
                    ->find()
                    ->where(['usuario_id' => $idUsuario, 'clase_id' => $idClase])
                    ->count() > 0;

                if (($this->Auth->user('rol') === 'administrador' || $clase->entrenador_id === $this->Auth->user('id')) && $esAlumno) {
                    $mensaje = $this->request->getData()['texto'];

                    $correo = new Email('default');
                    $correo
                        ->setEmailFormat('html')
                        ->from('padegest@abp.esei.es', 'Padegest')
                        ->subject('Mensaje de tu entrenador')
                        ->to('emailprueba@gmail.com')
                        ->send('El entrenador de la clase "' . $clase->nombre . '" en la que estás inscrito ha enviado un mensaje:<br><br>' . $mensaje);

                    $this->Flash->success(__('El mensaje ha sido enviado.'));
                } else {
                    $this->Flash->error(__('No tienes permisos para enviar ese mensaje.'));
                }
            } catch (RecordNotFoundException $exc) {
                $this->Flash->error(__('Ha ocurrido un error al enviar el mensaje.'));
            }

            return $this->redirect(['action' => 'view', $idClase]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Clase id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clase = $this->Clase->get($id);

        if ($this->Auth->user('rol') === 'entrenador' && $clase->entrenador_id !== $this->Auth->user('id')) {
            $this->Flash->error(__('La clase especificada no existe o no tienes permisos para borrarla.'));
        } else {
            if ($this->Clase->delete($clase)) {
                $this->Flash->success(__('La clase ha sido borrada.'));
            } else {
                $this->Flash->error(__('Ha ocurrido un error al borrar la clase.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inscribe a un deportista en una clase, si no lo estaba ya.
     *
     * @param string|null $id Clase id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function inscribirse($id = null)
    {
        $this->request->allowMethod(['get']);

        $tablaInscripciones = TableRegistry::getTableLocator()->get('ClaseUsuario');

        $inscripcionPrevia = $tablaInscripciones->find()
            ->where(['clase_id' => $id, 'usuario_id' => $this->Auth->user('id')])
            ->first();

        if ($inscripcionPrevia == null) {
            $inscripcion = $tablaInscripciones->newEntity();
            $inscripcion->clase_id = $id;
            $inscripcion->usuario_id = $this->Auth->user('id');

            if ($tablaInscripciones->save($inscripcion)) {
                $this->Flash->success(__('Te has inscrito con éxito.'));
            } else {
                $this->Flash->error(__('Ha ocurrido un error al inscribirte en esa clase.'));
            }
        } else {
            $this->Flash->success(__('Ya estabas inscrito en esa clase.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
