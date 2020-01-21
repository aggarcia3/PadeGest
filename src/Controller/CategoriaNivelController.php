<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CategoriaNivel Controller
 *
 * @property \App\Model\Table\CategoriaNivelTable $CategoriaNivel
 *
 * @method \App\Model\Entity\CategoriaNivel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriaNivelController extends AppController
{
    /**
     * @return bool
     */
    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), []) ||
               $user['rol'] === 'administrador';
    }

    public function index()
    {
        $categoriaNivel = $this->paginate($this->CategoriaNivel);

        $this->set(compact('categoriaNivel'));
    }

    /**
     * View method
     *
     * @param string|null $id Categoria Nivel id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoriaNivel = $this->CategoriaNivel->get($id, [
            'contain' => [],
        ]);

        $grupo = TableRegistry::getTableLocator()->get('Grupo');
        $resultsIteratorObject3 = $grupo->find()->where(['categoria_nivel_id' => $id])->all();

        $this->set(compact('categoriaNivel', 'resultsIteratorObject3'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoriaNivel = $this->CategoriaNivel->newEntity();
        if ($this->request->is('post')) {
            $categoriaNivel = $this->CategoriaNivel->patchEntity($categoriaNivel, $this->request->getData());
            if ($this->CategoriaNivel->save($categoriaNivel)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('categoriaNivel'));
    }

    public function add2($var)
    {
        $categoriaNivel = $this->CategoriaNivel->newEntity();
        if ($this->request->is('post')) {
            $categoriaNivel = $this->CategoriaNivel->patchEntity($categoriaNivel, $var);
            if ($this->CategoriaNivel->save($categoriaNivel)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('categoriaNivel'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Categoria Nivel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoriaNivel = $this->CategoriaNivel->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriaNivel = $this->CategoriaNivel->patchEntity($categoriaNivel, $this->request->getData());
            if ($this->CategoriaNivel->save($categoriaNivel)) {
                $this->Flash->success(__('The categoria nivel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categoria nivel could not be saved. Please, try again.'));
        }
        $this->set(compact('categoriaNivel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categoria Nivel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriaNivel = $this->CategoriaNivel->get($id);
        if ($this->CategoriaNivel->delete($categoriaNivel)) {
            $this->Flash->success(__('The categoria nivel has been deleted.'));
        } else {
            $this->Flash->error(__('The categoria nivel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
