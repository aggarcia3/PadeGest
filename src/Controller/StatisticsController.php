<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

/**
 * Statistics Controller
 *
 *
 * @method \App\Model\Entity\Statistic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatisticsController extends AppController
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
        return in_array($this->request->getParam('action'), ['statisticsUser']) ||
               $user['rol'] === 'administrador';

    }

    public function index()
    {
        //parte que calcula las reservas por mes
        $reservas = TableRegistry::getTableLocator()->get('Reserva');
        $resultsIteratorObject1 = $reservas->find()->all();
        

        $sdate = new FrozenTime('2019-11-00 00:00:00');   

        $edate = new FrozenTime('2019-12-00 00:00:00');  

        $fechaAux;
        $fechaInicio = FrozenTime::now();  
        $fechaFin = FrozenTime::now();  
        $query = $reservas->find('all');
        foreach( $query as $reserva):

            if($reserva['fechaInicio'] < $fechaInicio){
                $fechaInicio = $reserva['fechaInicio'];
            }

        endforeach;
        $fechaInicioDefinitiva = $fechaInicio; 

        $mesesDiferencia = ($fechaFin->year - $fechaInicio->year)*12;
        if($fechaInicio->month > $fechaFin->month){
            $mesesDiferencia += $fechaFin->month - $fechaInicio->month;
        }else if($fechaInicio->month > $fechaFin->month){
            $mesesDiferencia += 12-$fechaFin->month +$fechaInicio->month;
        }

        $i = 0;
        $contadores = array();
        $contadorReservas2 = 0;

        $reservas = TableRegistry::getTableLocator()->get('Reserva');
        
        for($i = 0; $i < $mesesDiferencia; $i++){
            
            $reservasPorMes = $reservas->find('all', array('conditions'=>array('RESERVA.fechaInicio BETWEEN '.'\''.$fechaInicio->i18nFormat('yyyy-MM-dd HH:mm:ss').'\''.' AND '.'\''.$fechaInicio->addMonth(1)->i18nFormat('yyyy-MM-dd HH:mm:ss').'\'')));
            foreach( $reservasPorMes as $reservasPorMes2):
                $contadorReservas2++;
            endforeach;
            
            $contadores[$i] = $contadorReservas2; 
            $contadorReservas2= 0;
            $fechaInicio = $fechaInicio->addMonth(1);
        }

        //fin parte que calcula las reservas por mes


        //parte que calcula la pista con más reservas
        $contadorAux = 0;
        $pistaId = -1;
        $pistaFinal = -1;
        $contadorPistaReservas = 0;
        $pistas = TableRegistry::getTableLocator()->get('Pista');
        $resultsIteratorObject2 = $pistas->find()->all();
        
        foreach( $resultsIteratorObject2 as $pistas):
            $reservas = TableRegistry::getTableLocator()->get('Reserva');
            $contadorAux = 0;
            $pistaId = -1;
            $resultsIteratorObject3 = $reservas->find()->where(['pista_id' => $pistas->id])->all();
            foreach( $resultsIteratorObject3 as $reservas):
                $contadorAux++;
                $pistaId = $reservas->pista_id;
    
            endforeach;
                if($contadorPistaReservas < $contadorAux){
                    $contadorPistaReservas = $contadorAux;
                    $pistaFinal = $pistaId;
                }
        endforeach;

        //fin parte que calcula la pista con más reservas


         //parte que calcula la hora con más reservas
         $contadorAux = 0;
         $contadorRes = 0;
         $horaAux;
         $horaFinal;
         $contadorHoraReservas = 0;
         $horas = ['09:00:00', '10:30:00', '12:00:00', '13:30:00', '15:00:00', '16:30:00','18:00:00', '19:30:00'];
         
         foreach( $horas as $hora):
            $reservas = TableRegistry::getTableLocator()->get('Reserva');
            $resultsIteratorObject4 = $reservas->find('all', array('conditions'=>array('RESERVA.fechaInicio LIKE'=>'%'.$hora.'%')));;
            $contadorAux = 0;
            $pistaId = -1;
            
            foreach( $resultsIteratorObject4 as $reservasHora):
                $contadorAux++;
                $horaAux = $hora;
            endforeach;
                if($contadorHoraReservas < $contadorAux){
                    $contadorHoraReservas = $contadorAux;
                    $horaFinal = $horaAux;
                }
         endforeach;
        

         $reservas = TableRegistry::getTableLocator()->get('Reserva');
         $resultsIteratorObject6 = $reservas->find('all');
         foreach( $resultsIteratorObject6 as $resultado):
            $contadorRes++;
         endforeach;

        
 
         //fin parte que calcula la horaa con más reservas

        $this->set(array('contadores' => $contadores, 'contadorPistaReservas' => $contadorPistaReservas, 'pistaFinal' => $pistaFinal,  'contadorHoraReservas' => $contadorHoraReservas, 'horaFinal' => $horaFinal, 'mesesDiferencia' => $mesesDiferencia, 'fechaInicioDefinitiva' => $fechaInicioDefinitiva, 'contadorReservas' => $contadorRes));
    }

    /**
     * View method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statistic = $this->Statistics->get($id, [
            'contain' => []
        ]);

        $this->set('statistic', $statistic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */


}
