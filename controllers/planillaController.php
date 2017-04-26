<?php

class planillaController extends Controller
{
    private $_planilla;

    public function __construct() {
        parent::__construct();
        $this->_planilla = $this->loadModel('planilla');
        $this->_view->setJs(array('planilla')); 
    }
    
    public function index()
    {
        $this->_view->planillas = $this->_planilla->getPlanillas();

        $this->_view->titulo = 'Planilla';
        $this->_view->renderizar('index', 'planilla');
    }
    
    public function nuevo()
    {
        
        $this->_view->titulo = 'Registro de Planillas';
        $this->_view->automotores = $this->_planilla->getAutomotores();
        $this->_view->conductores = $this->_planilla->getConductores();
        $this->_view->recorridos = $this->_planilla->getRecorridos();
        $this->_view->origenes = $this->_planilla->getOrigenes();
        $this->_view->pasajeros = $this->_planilla->getPasajeros();
        $this->_view->contrato = $this->_planilla->getConsecutivo();
        $this->_view->consec_transito = '9739'; //40578 201640578 9739

        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;

            for ($k=1; $k <= $this->getPostParam('i'); $k++) { 
                $this->_view->pax[($k-1)] = $this->_planilla->getPasajeroPorId($this->getPostParam('pax'.$k));
            }

            if($this->getPostParam('automotor')==0){
                $this->_view->_error = 'Debe seleccionar un automotor';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            if(!$this->getPostParam('fec_inicial')){
                $this->_view->_error = 'Debe introducir la fecha inicial';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            if(!$this->getPostParam('fec_final')){
                $this->_view->_error = 'Debe introducir la fecha final';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            if($this->getPostParam('fec_final') < $this->getPostParam('fec_inicial') ){
                $this->_view->_error = 'La fecha final debe ser superior a la inicial';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            /*if(!$this->getPostParam('contratante')){
                $this->_view->_error = 'Debe introducir la identificacion de un contratante válido';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }*/

            if($this->getPostParam('recorrido')==0){
                $this->_view->_error = 'Debe seleccionar un recorrido';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            if(!$this->getPostParam('pax1')){
                $this->_view->_error = 'Debe introducir al menos 1 pasajero';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            if(!$this->getPostParam('pax1')){
                $this->_view->_error = 'Debe introducir al menos 1 pasajero';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            $planilla = $this->_planilla->setPlanilla(
                    $this->getPostParam('contrato'),
                    $this->getPostParam('automotor'),
                    $this->getPostParam('consec_transito'),
                    $this->getPostParam('fec_inicial'),
                    $this->getPostParam('fec_final'),
                    $this->getPostParam('recorrido'),
                    $this->getPostParam('convenio'),
                    $this->getPostParam('pax1')
                    );
            
            if(!$planilla){
                $this->_view->_error = 'Error al registrar planilla';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            $conductores = $this->_planilla->setConductor(
                    $planilla,
                    $this->getPostParam('conductor')
                    );

            if(!$conductores){
                $this->_view->_error = 'Error al registrar conductores';
                $this->_view->renderizar('nuevo', 'planilla');
                exit;
            }

            for ($i=1; $i < $this->getPostParam('i'); $i++) { 
                $pasajeros = $this->_planilla->setPasajero(
                    $planilla,
                    $this->getPostParam('pax'.$i)
                    );

                if(!$pasajeros){
                    $this->_view->_error = 'Error al registrar pasajeros';
                    $this->_view->renderizar('nuevo', 'planilla');
                    exit;
                }
            }
            

             
            $this->_view->datos = false;
            $this->_view->_mensaje = 'Registro Completado, revise su email para activar su cuenta';
            $this->_view->renderizar('nuevo', 'registro');
        }        
        
        $this->_view->renderizar('nuevo', 'registro');
        
    }

    public function getContratante()
    {
        if($this->getPostParam('buscarContratante')){
            echo json_encode($this->_planilla->getPasajero($this->getPostParam('buscarContratante')));
        }
    }

    public function getPasajero()
    {
        if($this->getPostParam('buscarPasajero')){
            echo json_encode($this->_planilla->getPasajero($this->getPostParam('buscarPasajero')));
        }
    }


    public function getDestinos()
    {
        if($this->getPostParam('origen')){
            echo json_encode($this->_planilla->getDestinos($this->getPostParam('origen')));
        }
    }

    public function getRecorridos()
    {
        if($this->getPostParam('origen') && $this->getPostParam('destino')){
            echo json_encode($this->_planilla->getDestinos($this->getPostParam('origen'),$this->getPostParam('destino')));
        }
    }

    public function agregar_pasajero()
    {
        if($this->getPostParam('cedula')){
            $this->_pasajeros->setPasajero(
                    $this->getPostParam('cedula'),
                    $this->getPostParam('nombres'),
                    $this->getPostParam('apellidos'),
                    $this->getPostParam('direccion'),
                    $this->getPostParam('telefono')
                    );
        }
    }

}

?>