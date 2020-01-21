<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

/**
 * PartidoPromocionado Controller
 *
 * @property \App\Model\Table\PartidoPromocionadoTable $PartidoPromocionado
 *
 * @method \App\Model\Entity\PartidoPromocionado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
use Cake\Event\Event;

class PartidoPromocionadoController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $campeonato = (new CampeonatoController());
        $partidoPromocionado = (new PartidoPromocionadoController());
        $campeonato->agrupar();
        $partidoPromocionado->agrupar();
    }

    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['index', 'inscribirse']) ||
               $user['rol'] === 'administrador';
    }

    public function index()
    {
        $usuariosPartidosPromocionados = TableRegistry::getTableLocator()->get('UsuarioPartidoPromocionado');
        $partidoPromocionado = $this->paginate($this->PartidoPromocionado);
        if ($this->Auth->user('rol') != "administrador") {
            foreach ($partidoPromocionado as $partidoPromocionados) {
                $resultsIteratorObject = $usuariosPartidosPromocionados->find()->where(['partido_promocionado_id' => $partidoPromocionados['id']])->all();
                $var = 0;

                foreach ($resultsIteratorObject as $inscripciones) {
                    $var++;
                }
                if ($var == 4) {
                    unset($partidoPromocionados['id']);
                    unset($partidoPromocionados['nombre']);
                    unset($partidoPromocionados['fecha']);
                    unset($partidoPromocionados['reserva_id']);
                }
            }
        }
        if (!isset($partidoPromocionado)) {
            $partidoPromocionado = [];
        }
        $this->set(compact('partidoPromocionado'));
    }

    /**
     * View method
     *
     * @param string|null $id Partido Promocionado id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partidoPromocionado = $this->PartidoPromocionado->get($id, [
            'contain' => ['Usuario'],
        ]);
        $this->set('partidoPromocionado', $partidoPromocionado);
    }

    /**
     * TODO
     *
     * @param string|null $id Partido Promocionado id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inscribirse($id = null)
    {
        $usuariosPartidosPromocionados = TableRegistry::getTableLocator()->get('UsuarioPartidoPromocionado');
        $fecha_actual = FrozenTime::now();

        $partidoPromocionado = $this->PartidoPromocionado->get($id, [
            'contain' => ['Usuario'],
        ]);

        $resultsIteratorObject = $usuariosPartidosPromocionados->find()->where(['partido_promocionado_id' => $partidoPromocionado['id']])->all();
        $var = 0;

        foreach ($resultsIteratorObject as $inscripciones) {
            $var++;
        }
        if ($var == 4) {
            $this->Flash->error(__('No puedes acceder a esta URL, se notificará al administrador'));

            return $this->redirect(['action' => 'index']);
        }

        if ($partidoPromocionado['fecha']->subDays(2) <  $fecha_actual) {
            $this->Flash->error(__('No puedes acceder a esta URL, se notificará al administrador'));

            return $this->redirect(['action' => 'index']);
        }

        $this->set('partidoPromocionado', $partidoPromocionado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $partidoPromocionado = $this->PartidoPromocionado->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $fecha = $data['fecha'] . ' ' . $data['hora'] . ':00';
            unset($data['hora']);
            $data['fecha'] = new FrozenTime($fecha);
            $data['reserva_id'] = null;
            //debug($data);
            $partidoPromocionado = $this->PartidoPromocionado->patchEntity($partidoPromocionado, $data);
            if ($this->PartidoPromocionado->save($partidoPromocionado)) {
                $this->Flash->success(__('The partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The partido promocionado could not be saved. Please, try again.'));
        }
        $this->set(compact('partidoPromocionado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partidoPromocionado = $this->PartidoPromocionado->get($id, [
            'contain' => ['Usuario'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partidoPromocionado = $this->PartidoPromocionado->patchEntity($partidoPromocionado, $this->request->getData());
            if ($this->PartidoPromocionado->save($partidoPromocionado)) {
                $this->Flash->success(__('The partido promocionado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The partido promocionado could not be saved. Please, try again.'));
        }
        $usuario = $this->PartidoPromocionado->Usuario->find('list', ['limit' => 200]);
        $this->set(compact('partidoPromocionado', 'usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Partido Promocionado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partidoPromocionado = $this->PartidoPromocionado->get($id);
        if ($this->PartidoPromocionado->delete($partidoPromocionado)) {
            $this->Flash->success(__('The partido promocionado has been deleted.'));
        } else {
            $this->Flash->error(__('The partido promocionado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete2($id = null)
    {
        $partidoPromocionado = $this->PartidoPromocionado->get($id);
        $this->PartidoPromocionado->delete($partidoPromocionado);

        return $this->redirect(['controller' => 'index', 'action' => 'index']);
    }

    public function agrupar()
    {
        $fecha_actual = FrozenTime::now();
        $partidoPromocionado = $this->PartidoPromocionado->find('all');
        foreach ($partidoPromocionado as $partidoPromocionado) {
            if ($partidoPromocionado['fecha']->subDays(2) <  $fecha_actual) {
                $this->delete2($partidoPromocionado['id']);
            }
        }

        return null;
    }
}
