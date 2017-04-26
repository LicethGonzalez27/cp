<?php

class segurosController extends Controller
{
    private $_seguros;

    public function __construct() {
        parent::__construct();
        $this->_seguros = $this->loadModel('seguros');
    }
    
    public function index()
    {
       
        $this->_view->aseguradoras = $this->_seguros->getAseguradoras();
        $this->_view->soat = $this->_seguros->getSoat();
        
        $this->_view->titulo = 'Seguros';
        $this->_view->descripcion = 'Permite ingresar, consultar y actualizar los Seguros obligatorios del Parque Automotor';
        $this->_view->icono = 'gi gi-lock';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('nombre')){
                $this->_view->_error = 'Se necesita un nombre de aseguradora';
                $this->_view->renderizar('index', 'seguros');
                exit;
            }

            if(!$this->getPostParam('telefono')){
                $this->_view->_error = 'Se necesita un teléfono de aseguradora';
                $this->_view->renderizar('index', 'seguros');
                exit;
            }

            $this->_seguros->setAseguradora(
                    $this->getPostParam('nombre'),
                    $this->getPostParam('telefono')
                    );

            $this->redireccionar('seguros');
        }    

        $this->_view->renderizar('index', 'seguros');
    }

    public function soat()
    {
       
        $this->_view->automotores = $this->_seguros->getAutomotores();
        $this->_view->aseguradoras = $this->_seguros->getAseguradoras();
        
        $this->_view->titulo = 'Seguros - Nuevo SOAT';
        $this->_view->descripcion = 'Permite ingresar los Seguros obligatorios del Parque Automotor';
        $this->_view->icono = 'gi gi-lock';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if($this->getPostParam('automotor')==0){
                $this->_view->_error = 'Debe seleccionar un automotor';
                $this->_view->renderizar('soat', 'seguros');
                exit;
            }

            if($this->getPostParam('aseguradora')==0){
                $this->_view->_error = 'Debe seleccionar una aseguradora';
                $this->_view->renderizar('soat', 'seguros');
                exit;
            }

            if($this->_seguros->verificarPoliza($this->getPostParam('poliza'))){
                $this->_view->_error = 'Esta poliza ya se encuentra registrada';
                $this->_view->renderizar('soat', 'seguros');
                exit;
            }

            if(!$this->getPostParam('fec_expedicion')){
                $this->_view->_error = 'Debe introducir la fecha de expedición';
                $this->_view->renderizar('soat', 'seguros');
                exit;
            }

            if($this->getPostParam('fec_vencimiento') <= $this->getPostParam('fec_expedicion') ){
                $this->_view->_error = 'La fecha de vencimiento debe ser superior a la de expedición';
                $this->_view->renderizar('soat', 'seguros');
                exit;
            }

            $this->_seguros->setSoat(
                    $this->getPostParam('poliza'),
                    $this->getPostParam('fec_expedicion'),
                    $this->getPostParam('fec_vencimiento'),
                    $this->getPostParam('automotor'),
                    $this->getPostParam('aseguradora')
                    );

            $this->redireccionar('seguros');
        }    

        $this->_view->renderizar('soat', 'seguros');
    }

    public function editar($id = false)
    {
        if ($id == false) {
            $this->redireccionar('seguros');
        }
       
        $this->_view->automotores = $this->_seguros->getAutomotores();
        $this->_view->aseguradoras = $this->_seguros->getAseguradoras();

        $comparacion =  $this->_seguros->getSoatPorId($id);
        $this->_view->datos = $comparacion;
        
        $this->_view->titulo = 'Seguros - Nuevo SOAT';
        $this->_view->descripcion = 'Permite ingresar los Seguros obligatorios del Parque Automotor';
        $this->_view->icono = 'gi gi-lock';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if($this->getPostParam('automotor')==0){
                $this->_view->_error = 'Debe seleccionar un automotor';
                $this->_view->renderizar('editar', 'seguros');
                exit;
            }

            if($this->getPostParam('aseguradora')==0){
                $this->_view->_error = 'Debe seleccionar una aseguradora';
                $this->_view->renderizar('editar', 'seguros');
                exit;
            }

            if($comparacion['poliza'] != $this->getPostParam('poliza')){
                if($this->_seguros->verificarPoliza($this->getPostParam('poliza'))){
                    $this->_view->_error = 'Esta poliza ya se encuentra registrada';
                    $this->_view->renderizar('editar', 'seguros');
                    exit;
                }
            }

            
            if(!$this->getPostParam('fec_expedicion')){
                $this->_view->_error = 'Debe introducir la fecha de expedición';
                $this->_view->renderizar('editar', 'seguros');
                exit;
            }

            if($this->getPostParam('fec_vencimiento') <= $this->getPostParam('fec_expedicion') ){
                $this->_view->_error = 'La fecha de vencimiento debe ser superior a la de expedición';
                $this->_view->renderizar('editar', 'seguros');
                exit;
            }

            $this->_seguros->updateSoat(
                    $id,
                    $this->getPostParam('poliza'),
                    $this->getPostParam('fec_expedicion'),
                    $this->getPostParam('fec_vencimiento'),
                    $this->getPostParam('automotor'),
                    $this->getPostParam('aseguradora')
                    );

            $this->redireccionar('seguros');
        }    

        $this->_view->renderizar('editar', 'seguros');
    }
}

?>