<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Pareja Controller
 *
 * @property \App\Model\Table\ParejaTable $Pareja
 *
 * @method \App\Model\Entity\Pareja[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParejaController extends AppController
{
    /**
     * @return boolean
     */
    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['add', 'view']) ||
               $user['rol'] === 'administrador';
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $pareja = $this->paginate($this->Pareja);

        $this->set(compact('pareja'));
    }

    /**
     * View method
     *
     * @param string|null $id Pareja id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pareja = $this->Pareja->get($id, [
            'contain' => ['Enfrentamiento'],
        ]);

        $this->set('pareja', $pareja);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();
        $usuario = TableRegistry::getTableLocator()->get('Usuario');
        $user = $usuario->find()->where(['username' => $data['usernameCapitan']])->last();
        $var = $user->id;
        $genero1 = $user->genero;
        $user2 = $usuario->find()->where(['username' => $data['usernamePareja']])->last();
        $var2 = $user2->id;
        $genero2 = $user2->genero;

        $categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
        $categoriaNivel2 = $categoriaNivel->find()->where(['campeonato_id' => $data['campeonatoId'], 'categoria' => $data['categoria'], 'nivel' => $data['nivel']])->last();

        if ($data['categoria'] == $categoriaNivel2->categoria && $data['nivel'] == $categoriaNivel2->nivel) {
            $var3 = $categoriaNivel2->id;
        } else {
            $var3 = null;
        }


        //debug($genero1);
        //debug($genero2);
        //debug($data['categoria']);

        if ($data['categoria'] == "masculina" && ($genero1 != "masculino" || $genero2 != "masculino")) {
            $this->Flash->error(__('No te has inscrito en la categoria y nivel correcto'));

            return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
        } elseif ($data['categoria'] == "femenina" && ($genero1 != "femenino" || $genero2 != "femenino")) {
            $this->Flash->error(__('No te has inscrito en la categoria y nivel correcto'));

            return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
        } elseif ($data['categoria'] == "mixta" && (($genero1 == "masculino" && $genero2 == "masculino") || ($genero1 == "femenino" && $genero2 == "femenino"))) {
            $this->Flash->error(__('No te has inscrito en la categoria y nivel correcto'));

            return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
        } elseif ($data['usernameCapitan'] == $data['usernamePareja']) {
            $this->Flash->error(__('No te puedes inscribir a ti mismo'));

            return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
        }

        $pareja = $this->Pareja->newEntity();

        $data['idCapitan'] = $var;
        $data['idCompanero'] = $var2;
        $data['categoria_nivel_id'] = $var3;
        $data['grupo_id'] = null;

        unset($data['usernameCapitan']);
        unset($data['usernamePareja']);
        unset($data['categoria']);
        unset($data['nivel']);
        unset($data['nivel']);
        unset($data['campeonatoId']);

        if ($this->request->is('post')) {
            $pareja = $this->Pareja->patchEntity($pareja, $data);
            if ($this->Pareja->save($pareja)) {
                $this->Flash->success(__('Te has inscrito correctamente'));

                return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
            }
            $this->Flash->error(__('No se pudo realizar la inscripcion, inténtalo más tarde'));

            return $this->redirect(['controller' => 'campeonato', 'action' => 'index']);
        }
        $enfrentamiento = $this->Pareja->Enfrentamiento->find('list', ['limit' => 200]);
        $this->set(compact('pareja', 'enfrentamiento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pareja id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pareja = $this->Pareja->get($id, [
            'contain' => ['Enfrentamiento'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pareja = $this->Pareja->patchEntity($pareja, $this->request->getData());
            if ($this->Pareja->save($pareja)) {
                $this->Flash->success(__('The pareja has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pareja could not be saved. Please, try again.'));
        }
        $enfrentamiento = $this->Pareja->Enfrentamiento->find('list', ['limit' => 200]);
        $this->set(compact('pareja', 'enfrentamiento'));
    }

    public function edit2($var, $var2)
    {
        $pareja = $this->Pareja->get($var, [
            'contain' => ['Enfrentamiento'],
        ]);
            $pareja = $this->Pareja->patchEntity($pareja, $var2);
        if ($this->Pareja->save($pareja)) {
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The pareja could not be saved. Please, try again.'));
        }
        $enfrentamiento = $this->Pareja->Enfrentamiento->find('list', ['limit' => 200]);
        $this->set(compact('pareja', 'enfrentamiento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pareja id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pareja = $this->Pareja->get($id);
        if ($this->Pareja->delete($pareja)) {
            $this->Flash->success(__('The pareja has been deleted.'));
        } else {
            $this->Flash->error(__('The pareja could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
