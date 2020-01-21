<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

/**
 * UsuarioPartidoPromocionado Controller
 *
 * @property \App\Model\Table\UsuarioPartidoPromocionadoTable $UsuarioPartidoPromocionado
 *
 * @method \App\Model\Entity\UsuarioPartidoPromocionado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class UsuarioPartidoPromocionadoController extends AppController
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
        return in_array($this->request->getParam('action'), ['add']) ||
               $user['rol'] === 'administrador';
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Usuario', 'PartidoPromocionado'],
        ];
        $usuarioPartidoPromocionado = $this->paginate($this->UsuarioPartidoPromocionado);

        $this->set(compact('usuarioPartidoPromocionado'));
    }

    /**
     * View method
     *
     * @param string|null $id Usuario Partido Promocionado id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->get($id, [
            'contain' => ['Usuario', 'PartidoPromocionado'],
        ]);
        $this->set('usuarioPartidoPromocionado', $usuarioPartidoPromocionado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['usuario_id'] = $this->Auth->user('id');

            //se buscan y filtran todas las tuplas que tengan como id el enviado en el formulario
            $sitios = $this->UsuarioPartidoPromocionado->find('all');
            $sitiosFiltrado = $sitios->where(['partido_promocionado_id' => $data['partido_promocionado_id']]);

            $reservas = 0;
            foreach ($sitios as $sitios) {
                $reservas++;
            }

            $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->patchEntity($usuarioPartidoPromocionado, $data);
            if ($this->UsuarioPartidoPromocionado->save($usuarioPartidoPromocionado) && $reservas <= 4) {
                $this->Flash->success(__('Te has inscrito correctamente'));

                //Otra vez, se buscan y filtran todas las tuplas que tengan como id el enviado en el formulario para si es = 4 crear una reserva
                $sitios = $this->UsuarioPartidoPromocionado->find('all');
                $sitiosFiltrado = $sitios->where(['partido_promocionado_id' => $data['partido_promocionado_id']]);
                $reservas = 0;
                foreach ($sitios as $sitios) {
                    $reservas++;
                }

                if ($reservas == 4) {
                    //Borrar esta línea de código cuande se cree la reserva

                    FrozenTime::setToStringFormat('yyyy-MM-dd HH:mm:ss');

                    $partidos = TableRegistry::getTableLocator()->get('PartidoPromocionado');
                    $resultsIteratorObject4 = $partidos->find()->where(['id' => $data['partido_promocionado_id']])->all();
                    foreach ($resultsIteratorObject4 as $partidoPromocionado) {
                        $var['fechaInicio'] = $partidoPromocionado['fecha'];
                    }
                    $var['fechaInicio'] = $var['fechaInicio']->format('Y-m-d H:i:s');
                    $var['pista_id'] = 1;
                    $reserva = (new ReservaController());
                    $reserva->add2($var);
                }

                return $this->redirect(['controller' => 'partidoPromocionado', 'action' => 'index']);
            }

            if ($reservas > 4) {
                $this->Flash->error(__('Ya está lleno el partido'));
            } else {
                $this->Flash->error(__('No te has podido inscribir, inténtalo de nuevo'));
            }

            return $this->redirect(['controller' => 'partidoPromocionado', 'action' => 'index']);
        }

        $usuario = $this->UsuarioPartidoPromocionado->Usuario->find('list', ['limit' => 200]);
        $partidoPromocionado = $this->UsuarioPartidoPromocionado->PartidoPromocionado->find('list', ['limit' => 200]);
        $this->set(compact('usuarioPartidoPromocionado', 'usuario', 'partidoPromocionado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->patchEntity($usuarioPartidoPromocionado, $this->request->getData());
            if ($this->UsuarioPartidoPromocionado->save($usuarioPartidoPromocionado)) {
                $this->Flash->success(__('The usuario partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario partido promocionado could not be saved. Please, try again.'));
        }
        $usuario = $this->UsuarioPartidoPromocionado->Usuario->find('list', ['limit' => 200]);
        $partidoPromocionado = $this->UsuarioPartidoPromocionado->PartidoPromocionado->find('list', ['limit' => 200]);
        $this->set(compact('usuarioPartidoPromocionado', 'usuario', 'partidoPromocionado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuarioPartidoPromocionado = $this->UsuarioPartidoPromocionado->get($id);
        if ($this->UsuarioPartidoPromocionado->delete($usuarioPartidoPromocionado)) {
            $this->Flash->success(__('The usuario partido promocionado has been deleted.'));
        } else {
            $this->Flash->error(__('The usuario partido promocionado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
