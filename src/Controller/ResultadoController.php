<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Resultado Controller
 *
 * @property \App\Model\Table\ResultadoTable $Resultado
 *
 * @method \App\Model\Entity\Resultado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResultadoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function isAuthorized($user)
    {
        // Los usuarios no administradores solo tienen acceso a las acciones index y logout.
        // De otro modo, el proceso de conexión desembocaría en un bucle infinito de redirecciones,
        // y los usuarios no se podrían desconectar
        return in_array($this->request->getParam('action'), ['']) ||
               $user['rol'] === 'administrador';

    }

    public function index()
    {
        $resultado = $this->paginate($this->Resultado);

        $this->set(compact('resultado'));
    }

    /**
     * View method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultado = $this->Resultado->get($id, [
            'contain' => []
        ]);

        $this->set('resultado', $resultado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idEnfrentamiento = null)
    {
        $resultado = $this->Resultado->newEntity();
        if ($this->request->is('post')) {

            $var = $this->request->getData();
            debug($var);

            $res1 = 0;
            $res2 = 15;

            if($var['set1pareja1'] > 7 || $var['set1pareja2'] > 7 || $var['set2pareja1'] > 7 || $var['set2pareja2'] > 7 || $var['set3pareja1'] > 7 || $var['set3pareja2'] > 7){
                $this->Flash->error(__('No se pueden introducir resultados mayores que 7'));
                return $this->redirect(['controller' => 'Enfrentamiento', 'action' => 'view', $idEnfrentamiento]);
            }

            if($var['set1pareja1'] == $var['set1pareja2'] || $var['set2pareja1'] == $var['set2pareja2']){
                $this->Flash->error(__('No puede haber empates en los sets'));
                return $this->redirect(['controller' => 'Enfrentamiento', 'action' => 'view', $idEnfrentamiento]);
            }

            if($var['set1pareja1'] > $var['set1pareja2']){
                    $res1 = 1;
            }
            else{
                    $res1 = 2;
            }

            if($var['set2pareja1'] > $var['set2pareja2']){
                    $res2 = 1;
            }
            else{
                $res2 = 2;
            }

            if($res1 == $res2 && $var['set1pareja1'] != '' && $var['set1pareja2'] != ''){
                $this->Flash->error(__('No hace falta el tercer set al haber ya un ganador'));
                return $this->redirect(['controller' => 'Enfrentamiento', 'action' => 'view', $idEnfrentamiento]);
            }


            $resultado = $this->Resultado->patchEntity($resultado, $var);
            $resultado['enfrentamiento_id'] = $idEnfrentamiento;
            if ($this->Resultado->save($resultado)) {
                $this->Flash->success(__('Has introducido bien el resultado'));

                return $this->redirect(['controller' => 'Enfrentamiento', 'action' => 'view', $idEnfrentamiento]);
            }
            $this->Flash->error(__('The resultado could not be saved. Please, try again.'));
        }
        
        $this->set(array('resultado' => $resultado, 'idEnfrentamiento' => $idEnfrentamiento));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultado = $this->Resultado->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resultado = $this->Resultado->patchEntity($resultado, $this->request->getData());
            if ($this->Resultado->save($resultado)) {
                $this->Flash->success(__('The resultado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resultado could not be saved. Please, try again.'));
        }
        $this->set(compact('resultado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultado = $this->Resultado->get($id);
        if ($this->Resultado->delete($resultado)) {
            $this->Flash->success(__('The resultado has been deleted.'));
        } else {
            $this->Flash->error(__('The resultado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
