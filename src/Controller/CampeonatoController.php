<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
/**
 * Campeonato Controller
 *
 * @property \App\Model\Table\CampeonatoTable $Campeonato
 *
 * @method \App\Model\Entity\Campeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class CampeonatoController extends AppController
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
        return in_array($this->request->getParam('action'), ['view', 'index', 'inscribirse']) ||
               $user['rol'] === 'administrador';

    }

    public function inscribirse($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);

        $this->set('campeonato', $campeonato);
    }

    public function index()
    {
        $campeonato = $this->paginate($this->Campeonato);

        $this->set(compact('campeonato'));
    }

    /**
     * View method
     *
     * @param string|null $id Campeonato id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);

        $this->set('campeonato', $campeonato);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $campeonato = $this->Campeonato->newEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $var = $data['nombre'];
            $campeonato = $this->Campeonato->patchEntity($campeonato, $this->request->getData());
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                $resultsIteratorObject = $this->Campeonato->find()->where(['nombre' => $var])->all();
                foreach ($resultsIteratorObject as $campeonato) {
                    $var2 = $campeonato->id;
                }
                
                $CategoriaNivel = (new CategoriaNivelController());
                $categoria1['campeonato_id'] = $var2;
                $categoria1['categoria'] = 'masculina';
                $categoria1['nivel'] = '1';
                $CategoriaNivel->add2($categoria1);

                $categoria2['campeonato_id'] = $var2;
                $categoria2['categoria'] = 'femenina';
                $categoria2['nivel'] = '1';
                $CategoriaNivel->add2($categoria2);

                $categoria3['campeonato_id'] = $var2;
                $categoria3['categoria'] = 'mixta';
                $categoria3['nivel'] = '1';
                $CategoriaNivel->add2($categoria3);

                $categoria4['campeonato_id'] = $var2;
                $categoria4['categoria'] = 'masculina';
                $categoria4['nivel'] = '2';
                $CategoriaNivel->add2($categoria4);

                $categoria5['campeonato_id'] = $var2;
                $categoria5['categoria'] = 'femenina';
                $categoria5['nivel'] = '2';
                $CategoriaNivel->add2($categoria5);

                $categoria6['campeonato_id'] = $var2;
                $categoria6['categoria'] = 'mixta';
                $categoria6['nivel'] = '2';
                $CategoriaNivel->add2($categoria6);

                $categoria7['campeonato_id'] = $var2;
                $categoria7['categoria'] = 'masculina';
                $categoria7['nivel'] = '3';
                $CategoriaNivel->add2($categoria7);

                $categoria8['campeonato_id'] = $var2;
                $categoria8['categoria'] = 'femenina';
                $categoria8['nivel'] = '3';
                $CategoriaNivel->add2($categoria8);

                $categoria8['campeonato_id'] = $var2;
                $categoria8['categoria'] = 'mixta';
                $categoria8['nivel'] = '3';
                $CategoriaNivel->add2($categoria8);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campeonato could not be saved. Please, try again.'));
        }
        $this->set(compact('campeonato'));

        
    }

    /**
     * Edit method
     *
     * @param string|null $id Campeonato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $campeonato = $this->Campeonato->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $campeonato = $this->Campeonato->patchEntity($campeonato, $this->request->getData());
            if ($this->Campeonato->save($campeonato)) {
                $this->Flash->success(__('The campeonato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campeonato could not be saved. Please, try again.'));
        }
        $this->set(compact('campeonato'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Campeonato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $campeonato = $this->Campeonato->get($id);
        if ($this->Campeonato->delete($campeonato)) {
            $this->Flash->success(__('The campeonato has been deleted.'));
        } else {
            $this->Flash->error(__('The campeonato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function agrupar(){
        $fecha_actual = FrozenTime::now();
        $campeonatos = $this->Campeonato->find('all');
        $i = 0;
        foreach($campeonatos as $campeonato){
            if($campeonato['fechaFinInscripciones'] <  $fecha_actual){
                $var[$i] = $campeonato['id'];
                $i++;
            }
        }
        $j = 0;
        $categoriaNivel = TableRegistry::getTableLocator()->get('CategoriaNivel');
        $resultsIteratorObject = $categoriaNivel->find()->where(['campeonato_id' => $var[0]])->all();

        foreach ($resultsIteratorObject as $categoriaNivel) {
            $var2[$j] = $campeonato['id'];
                $j++;
        }
        debug($var2[0]);
        $pareja = TableRegistry::getTableLocator()->get('Pareja');
        $resultsIteratorObject2 = $pareja->find()->where(['categoria_nivel_id' => $var2[0]])->all();
        foreach ($resultsIteratorObject2 as $pareja) {
            debug($pareja);
        }
        die();
    }
}
