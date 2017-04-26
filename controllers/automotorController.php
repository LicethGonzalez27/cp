<?php

class automotorController extends Controller
{
	private $_automotor;

    public function __construct() {
        parent::__construct();
        $this->_automotor = $this->loadModel('automotor');
        $this->_view->setJs(array('automotor')); 
    }
    
    public function index()
    {       
        $this->_view->titulo = 'Parque automotor';
        $this->_view->descripcion = 'Permite agregar vehiculos al Parque Automotor, consultarlos y modificarlos';
        $this->_view->icono = 'gi gi-cars';
        $this->_view->automotores = $this->_automotor->getAutomotores();

        $this->_view->renderizar('index', 'automotor');
    }

	public function nuevo()
	{
  		$this->_view->titulo = 'Registro de Automotores';
        $this->_view->descripcion = 'Permite agregar vehiculos al Parque Automotor, consultarlos y modificarlos';
        $this->_view->icono = 'gi gi-cars';
        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('numero')){
                $this->_view->_error = 'Debe introducir numero del vehiculo';
                $this->_view->renderizar('nuevo', 'automotor');
                exit;
            }


            if(!$this->getPostParam('placa')){
                $this->_view->_error = 'Debe introducir la placa del vehiculo';
                $this->_view->renderizar('nuevo', 'automotor');
                exit;
            }

            if($this->getPostParam('marca') == "0"){
                $this->_view->_error = 'Debe introducir la marca del vehiculo';
                $this->_view->renderizar('nuevo', 'automotor');
                exit;
            }

             if($this->getPostParam('clase') == "0"){
                $this->_view->_error = 'Debe introducir la clase del vehiculo';
                $this->_view->renderizar('nuevo', 'automotor');
                exit;
            }

             if(!$this->getPostParam('modelo')){
                $this->_view->_error = 'Debe introducir modelo del vehiculo';
                $this->_view->renderizar('nuevo', 'automotor');
                exit;
            }

             $this->_automotor->setAutomotor(
                    $this->getPostParam('numero'),
                    $this->getPostParam('placa'),
                    $this->getPostParam('marca'),
                    $this->getPostParam('clase'),
                    $this->getPostParam('modelo')
                    );


             $this->redireccionar('automotor');
        }

        $this->_view->renderizar('nuevo', 'automotor');

	}

    public function ver($id = false)
    {   
        if ($id == false) {
            $this->redireccionar('automotor');
        }

        $this->_view->automotor = $this->_automotor->getAutomotorPorId($id);
        $this->_view->soat = $this->_automotor->getSoatPorAutomotor($id);
        $this->_view->tarjeta = $this->_automotor->getTarjetaPorAutomotor($id);
        $this->_view->tecnomecanicas = $this->_automotor->getTecnomecanicasPorAutomotor($id);

        $this->_view->titulo = 'Vehículo - '.$this->_view->automotor['numero'];
        $this->_view->descripcion = 'Toda la información correspondiente al vehículo';
        $this->_view->icono = 'gi gi-cars';
        

        $this->_view->renderizar('ver', 'automotor');
    }

    public function editar($id = false)
    {

        if ($id == false) {
            $this->redireccionar('automotor');
        }

        $this->_view->titulo = 'Actualizar Automotor';

        $this->_view->datos = $this->_automotor->getAutomotorPorId($id);
        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('numero')){
                $this->_view->_error = 'Debe introducir numero del vehiculo';
                $this->_view->renderizar('editar', 'automotor');
                exit;
            }


            if(!$this->getPostParam('placa')){
                $this->_view->_error = 'Debe introducir la placa del vehiculo';
                $this->_view->renderizar('editar', 'automotor');
                exit;
            }

            if($this->getPostParam('marca') == "0"){
                $this->_view->_error = 'Debe introducir la marca del vehiculo';
                $this->_view->renderizar('editar', 'automotor');
                exit;
            }

             if($this->getPostParam('clase') == "0"){
                $this->_view->_error = 'Debe introducir la clase del vehiculo';
                $this->_view->renderizar('editar', 'automotor');
                exit;
            }

             if(!$this->getPostParam('modelo')){
                $this->_view->_error = 'Debe introducir modelo del vehiculo';
                $this->_view->renderizar('editar', 'automotor');
                exit;
            }

             $this->_automotor->updateAutomotor(
                    $id,
                    $this->getPostParam('numero'),
                    $this->getPostParam('placa'),
                    $this->getPostParam('marca'),
                    $this->getPostParam('clase'),
                    $this->getPostParam('modelo')
                    );


             $this->redireccionar('automotor');
        }

        $this->_view->renderizar('editar', 'automotor');

    }


    public function agregar_vehiculo()
    {
        if($this->getPostParam('numero')){
            $this->_automotor->setAutomotor(
                    $this->getPostParam('numero'),
                    $this->getPostParam('placa'),
                    $this->getPostParam('marca'),
                    $this->getPostParam('clase'),
                    $this->getPostParam('modelo')
                    );
        }
    }
}
?>