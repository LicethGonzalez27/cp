<?php

class tarjeta_operacionController extends Controller
{
	private $_tarjeta_operacion;

    public function __construct() {
        parent::__construct();
        $this->_tarjeta_operacion = $this->loadModel('tarjeta_operacion');

    }
    
    public function index()
    {       
        $this->_view->tarjetas = $this->_tarjeta_operacion->getTarjetas();
        $this->_view->titulo = 'Tarjetas de Operación';
        $this->_view->descripcion = 'Permite ingresar, consultar y actualizar la Tarjeta de Operación del Parque Automotor';
        $this->_view->icono = 'gi gi-credit_card';

        $this->_view->renderizar('index', 'tarjeta_operacion');
    }

    public function nuevo()
    {
       
        $this->_view->automotores = $this->_tarjeta_operacion->getAutomotores();
        
        $this->_view->titulo = 'Tarjetas de Operación - Nueva';
        $this->_view->descripcion = 'Permite actualizar la Tarjeta de Operación del Parque Automotor';
        $this->_view->icono = 'gi gi-credit_card';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if($this->getPostParam('automotor')==0){
                $this->_view->_error = 'Debe seleccionar un automotor';
                $this->_view->renderizar('nuevo', 'tarjeta_operacion');
                exit;
            }

            if(!$this->getPostParam('tarjeta')){
                $this->_view->_error = 'Debe ingresar el código de la tarjeta';
                $this->_view->renderizar('nuevo', 'tarjeta_operacion');
                exit;
            }

            if($this->_tarjeta_operacion->verificarTarjeta($this->getPostParam('tarjeta'))){
                $this->_view->_error = 'Esta tarjeta ya se encuentra registrada';
                $this->_view->renderizar('nuevo', 'tarjeta_operacion');
                exit;
            }

            if($this->getPostParam('capacidad')<=0){
                $this->_view->_error = 'Capacidad de pasajeros no válida';
                $this->_view->renderizar('nuevo', 'tarjeta_operacion');
                exit;
            }

            if(!$this->getPostParam('fec_expedicion')){
                $this->_view->_error = 'Debe introducir la fecha de expedición';
                $this->_view->renderizar('nuevo', 'tarjeta_operacion');
                exit;
            }

            if($this->getPostParam('fec_vencimiento') <= $this->getPostParam('fec_expedicion') ){
                $this->_view->_error = 'La fecha de vencimiento debe ser superior a la de expedición';
                $this->_view->renderizar('nuevo', 'tarjeta_operacion');
                exit;
            }

            $this->_tarjeta_operacion->setTarjeta(
                    $this->getPostParam('tarjeta'),
                    $this->getPostParam('capacidad'),
                    $this->getPostParam('fec_expedicion'),
                    $this->getPostParam('fec_vencimiento'),
                    $this->getPostParam('automotor'),
                    '1'
                    );

            $this->redireccionar('tarjeta_operacion');
        }    

        $this->_view->renderizar('nuevo', 'tarjeta_operacion');
    }

    public function editar($id = false)
    {
        if ($id == false) {
            $this->redireccionar('seguros');
        }
       
        $this->_view->automotores = $this->_tarjeta_operacion->getAutomotores();

        $comparacion =  $this->_tarjeta_operacion->getTarjetaPorId($id);
        $this->_view->datos = $comparacion;
        
        $this->_view->titulo = 'Tarjetas de Operación - Editar';
        $this->_view->descripcion = 'Permite actualizar la Tarjeta de Operación del Parque Automotor';
        $this->_view->icono = 'gi gi-credit_card';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if($this->getPostParam('automotor')==0){
                $this->_view->_error = 'Debe seleccionar un automotor';
                $this->_view->renderizar('editar', 'tarjeta_operacion');
                exit;
            }

            if(!$this->getPostParam('tarjeta')){
                $this->_view->_error = 'Debe ingresar el código de la tarjeta';
                $this->_view->renderizar('editar', 'tarjeta_operacion');
                exit;
            }

            if($comparacion['tarjeta'] != $this->getPostParam('tarjeta')){
                if($this->_tarjeta_operacion->verificarTarjeta($this->getPostParam('tarjeta'))){
                    $this->_view->_error = 'Esta tarjeta ya se encuentra registrada';
                    $this->_view->renderizar('editar', 'tarjeta_operacion');
                    exit;
                }
            }

            if($this->getPostParam('capacidad')<=0){
                $this->_view->_error = 'Capacidad de pasajeros no válida';
                $this->_view->renderizar('editar', 'tarjeta_operacion');
                exit;
            }

            if(!$this->getPostParam('fec_expedicion')){
                $this->_view->_error = 'Debe introducir la fecha de expedición';
                $this->_view->renderizar('editar', 'tarjeta_operacion');
                exit;
            }

            if($this->getPostParam('fec_vencimiento') <= $this->getPostParam('fec_expedicion') ){
                $this->_view->_error = 'La fecha de vencimiento debe ser superior a la de expedición';
                $this->_view->renderizar('editar', 'tarjeta_operacion');
                exit;
            }

            $this->_tarjeta_operacion->updateTarjeta(
                    $id,
                    $this->getPostParam('tarjeta'),
                    $this->getPostParam('capacidad'),
                    $this->getPostParam('fec_expedicion'),
                    $this->getPostParam('fec_vencimiento'),
                    $this->getPostParam('automotor')
                    );

            $this->redireccionar('tarjeta_operacion');
        }    

        $this->_view->renderizar('editar', 'tarjeta_operacion');
    }
}

?>