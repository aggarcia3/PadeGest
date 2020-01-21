<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;

/**
 * Noticia Controller
 *
 * @property \App\Model\Table\NoticiaTable $Noticia
 *
 * @method \App\Model\Entity\Noticium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NoticiaController extends AppController
{

    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['view', 'index']) ||
               $user['rol'] === 'administrador';

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $fecha_actual = FrozenTime::now();

        $noticias = $this->paginate($this->Noticia);
        if($this->Auth->user('rol') != "administrador"){
            foreach($noticias as $noticia){
                if($noticia['fecha'] >  $fecha_actual){
                    unset($noticia['id']);
                    unset($noticia['titulo']);
                    unset($noticia['cuerpo']);
                    unset($noticia['fecha']);
                }
            }
        }

        $this->set(compact('noticias'));
    }

    /**
     * View method
     *
     * @param string|null $id Noticium id.
     * @return \Cake\Http\Response|null
     */
    public function view($id = null)
    {
        try{
            $noticium = $this->Noticia->get($id, [
                'contain' => ['Usuario'],
            ]);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe.', __('noticium')));

            $this->viewBuilder()->setTemplate('index');

            $this->index();
        }

        $this->set(compact('noticium'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $noticium = $this->Noticia->newEntity($this->request->getData());

            if ($this->Noticia->save($noticium)) {
                $this->Flash->success(__('{0} creada con éxito.', __('Noticia')));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        } else {
            $noticium = $this->Noticia->newEntity();
        }

        $this->set(compact('noticium'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Noticium id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     */
    public function edit($id = null)
    {
        try{
            $noticium = $this->Noticia->get($id);
        } catch (RecordNotFoundException $_) {
            $this->Flash->error(__('La {0} especificada no existe, por lo que no se puede editar.', __('pista')));

            return $this->redirect(['action' => 'index']);
        }

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $noticium = $this->Noticia->patchEntity($noticium, $this->request->getData());

            if ($this->Noticia->save($noticium)) {
                $this->Flash->success(__('{0} editada con éxito.', [__('Noticia')]));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
        }

        $this->set(compact('noticium'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Noticium id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);

        try {
            $noticium = $this->Noticia->get($id);

            if ($this->Noticia->delete($noticium)) {
                $this->Flash->success(__('{0} borrada con éxito.', __('Noticia')));
            } else {
                $this->Flash->error(__('Ha ocurrido un error al realizar la operación solicitada. Por favor, vuélvelo a intentar más tarde.'));
            }
        } catch (RecordNotFoundException $_) {
            // Ignorar el error
            $this->Flash->success(__('{0} borrada con éxito.', __('Noticia')));
        }

        return $this->redirect(['action' => 'index']);
    }
}
