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

        
 
         //fin parte que calcula la hora con más reservas

         //inicio calculo de pagos por semana

        $reservas = TableRegistry::getTableLocator()->get('Pago');
        $resultsIteratorObject1 = $reservas->find()->all();

        $fechaAux2;
        $fechaInicio2 = FrozenTime::now();  
        $fechaFin2 = FrozenTime::now();  
        $query2 = $reservas->find('all');
        foreach( $query2 as $pago):

            if($pago['fecha'] < $fechaInicio2){
                $fechaInicio2 = $pago['fecha'];
            }

        endforeach;
        $fechaInicioDefinitiva2 = $fechaInicio2; 

        $mesesDiferencia2 = ($fechaFin2->year - $fechaInicio2->year)*12;
        if($fechaInicio2->month > $fechaFin2->month){
            $mesesDiferencia2 += $fechaFin2->month - $fechaInicio2->month;
        }else if($fechaInicio2->month > $fechaFin2->month){
            $mesesDiferencia2 += 12-$fechaFin2->month +$fechaInicio2->month;
        }

        $i2 = 0;
        $contadores2 = array();
        $contadorPago2 = 0;

        $pagos = TableRegistry::getTableLocator()->get('Pago');
        $importePorMes = array();
        $importe = 0;
        
        for($i2 = 0; $i2 < $mesesDiferencia2; $i2++){
            
            $pagosPorMes = $pagos->find('all', array('conditions'=>array('PAGO.fecha BETWEEN '.'\''.$fechaInicio2->i18nFormat('yyyy-MM-dd HH:mm:ss').'\''.' AND '.'\''.$fechaInicio2->addMonth(1)->i18nFormat('yyyy-MM-dd HH:mm:ss').'\'')));
            foreach( $pagosPorMes as $pagoPorMes2):
                $contadorPago2++;

                $importe += $pagoPorMes2['importe'];
                
            endforeach;
            
            $contadores2[$i2] = $contadorPago2; 
            $contadorPago2= 0;
            $importePorMes[$i2] = $importe;
            $importe = 0;
            $fechaInicio2 = $fechaInicio2->addMonth(1);
        }
        //fin de calculo de pagos por mes

        //calculo de de suma de pago

        $reservas = TableRegistry::getTableLocator()->get('Pago');
        $resultsIteratorObject4 = $reservas->find()->all();

        $importeTotal = 0;

        foreach($resultsIteratorObject4 as $pagos){
            $importeTotal+=$pagos['importe'];
        }


        //fin de calculo de suma de pago 

        //calculo de clase mas atendida


        //fin de calculo de clase mas atendida


        $this->set(array('contadores' => $contadores, 'contadorPistaReservas' => $contadorPistaReservas, 'pistaFinal' => $pistaFinal,  'contadorHoraReservas' => $contadorHoraReservas, 'horaFinal' => $horaFinal, 'mesesDiferencia' => $mesesDiferencia, 'fechaInicioDefinitiva' => $fechaInicioDefinitiva, 'contadorReservas' => $contadorRes, 'fechaInicioDefinitiva2' => $fechaInicioDefinitiva2, 'contadores2' => $contadores2, 'importeTotal' => $importeTotal, 'importePorMes' => $importePorMes));
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
