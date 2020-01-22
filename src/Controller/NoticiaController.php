<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\NoticiaTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;

/**
 * Noticia Controller
 *
 * @property \App\Model\Table\NoticiaTable $Noticia
 *
 * @method \App\Model\Entity\Noticium[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NoticiaController extends AppController
{
    /**
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $tablaNoticia = TableRegistry::getTableLocator()->get('Noticia');
        assert($tablaNoticia instanceof NoticiaTable);
        $tablaNoticia->setAuth($this->Auth);
    }

    /** @return bool */
    public function isAuthorized($user)
    {
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
        $noticias = $this->paginate($this->Noticia);
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
        try {
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
        $fecha_actual = FrozenTime::now(); 
    
        if ($this->request->is('post')) {
            $noticium = $this->Noticia->newEntity($this->request->getData());
            $noticium->usuario_id = $this->Auth->user('id');
            $noticium->fecha = $fecha_actual;

            if ($this->Noticia->save($noticium)) {

                TransportFactory::setConfig('mailtrap', [
                    'host' => 'smtp.mailtrap.io',
                    'port' => 2525,
                    'username' => '8bf4341c41b90b',
                    'password' => '7ebfbfaa262629',
                    'className' => 'Smtp'
                  ]);

                    $email = new Email();
                    $email->transport('mailtrap');
                    $email->emailFormat('html');
                    $email->from('padegest@abp.esei.es', 'Padegest');
                    $email->subject('Nueva noticia añadida');
                    $email->to('emailprueba@gmail.com');
                    $email->send('Hola, se ha publicado una nueva noticia en la aplicaión Padegest <br> <a href="http://localhost:8765/noticia">Haz clic aquí para ver la noticia</a>');

                $this->Flash->success(__('{0} creada con éxito.', __('Noticia')));
                $this->Flash->success(__('Se ha enviado un email a todos los usuarios'));

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
        try {
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
