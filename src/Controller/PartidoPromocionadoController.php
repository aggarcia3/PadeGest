<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * PartidoPromocionado Controller
 *
 * @property \App\Model\Table\PartidoPromocionadoTable $PartidoPromocionado
 *
 * @method \App\Model\Entity\PartidoPromocionado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
Time::setDefaultLocale('es-ES');
Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
class PartidoPromocionadoController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $partidoPromocionado = $this->paginate($this->PartidoPromocionado);

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
            'contain' => ['Usuario']
        ]);
        $this->set('partidoPromocionado', $partidoPromocionado);
    }

    public function inscribirse($id = null)
    {
        $partidoPromocionado = $this->PartidoPromocionado->get($id, [
            'contain' => ['Usuario']
        ]);
        $this->set('partidoPromocionado', $partidoPromocionado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.rol') == "administrador"){
            
            $partidoPromocionado = $this->PartidoPromocionado->newEntity();

            if ($this->request->is('post')) {
                $data = $this->request->getData();
                $fecha = $data['fecha'].' '.$data['hora'].':00';
                unset($data['hora']);
                $data['fecha'] = new Time($fecha);
                $data['reserva_id'] = null;
                debug($data);
                $partidoPromocionado = $this->PartidoPromocionado->patchEntity($partidoPromocionado, $data);
                if ($this->PartidoPromocionado->save($partidoPromocionado)) {
                    $this->Flash->success(__('The partido promocionado has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The partido promocionado could not be saved. Please, try again.'));
            }
            $this->set(compact('partidoPromocionado'));

        }else{
            return $this->redirect(
                array('controller' => 'Usuario', 'action' => 'logout'));
        }

        
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
        if($this->request->session()->read('Auth.User.rol') == "administrador"){
            $partidoPromocionado = $this->PartidoPromocionado->get($id, [
                'contain' => ['Usuario']
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
        }else{
            return $this->redirect(
                array('controller' => 'Usuario', 'action' => 'logout'));
        } 
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

        if($this->request->session()->read('Auth.User.rol') == "administrador"){
            $this->request->allowMethod(['post', 'delete']);
            $partidoPromocionado = $this->PartidoPromocionado->get($id);
            if ($this->PartidoPromocionado->delete($partidoPromocionado)) {
                $this->Flash->success(__('The partido promocionado has been deleted.'));
            } else {
                $this->Flash->error(__('The partido promocionado could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }else{
            return $this->redirect(
                array('controller' => 'Usuario', 'action' => 'logout'));
        }

        
    }
}
