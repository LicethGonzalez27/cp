<?php

class pasajerosController extends Controller
{
    private $_pasajeros;

    public function __construct() {
        parent::__construct();
        $this->_pasajeros = $this->loadModel('pasajeros');
        $this->_view->setJs(array('pasajeros')); 
    }
    
    public function index()
    {
        
        $this->_view->titulo = 'Pasajeros';
        $this->_view->descripcion = 'Muestra la información de clientes y pasajeros';
        $this->_view->icono = 'gi gi-parents';
        $this->_view->pasajeros = $this->_pasajeros->getPasajeros();
        $this->_view->renderizar('index', 'pasajeros');
    }
    
    public function nuevo()
    {
        
        $this->_view->titulo = 'Pasajeros';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('documento')){
                $this->_view->_error = 'Debe introducir el Documento de Identidad';
                $this->_view->renderizar('nuevo', 'pasajeros');
                exit;
            }

            if($this->_pasajeros->verificarPasajero($this->getPostParam('documento'))){
                $this->_view->_error = 'Este documento ya se encuentra registrado';
                $this->_view->renderizar('nuevo', 'pasajeros');
                exit;
            }

            if(!$this->getPostParam('nombres')){
                $this->_view->_error = 'Debe introducir un nombre';
                $this->_view->renderizar('nuevo', 'pasajeros');
                exit;
            }

            if(!$this->getPostParam('apellidos')){
                $this->_view->_error = 'Debe introducir al menos un apellido';
                $this->_view->renderizar('nuevo', 'pasajeros');
                exit;
            }

            $this->_pasajeros->setPasajero(
                    $this->getPostParam('documento'),
                    $this->getPostParam('nombres'),
                    $this->getPostParam('apellidos'),
                    $this->getPostParam('direccion'),
                    $this->getPostParam('telefono')
                    );


             $this->redireccionar('pasajeros');
        }    

        $this->_view->renderizar('nuevo', 'pasajeros');
    }

    public function editar($id = false)
    {
        if ($id == false) {
            $this->redireccionar('pasajeros');
        }

        $this->_view->titulo = 'Pasajeros';
        $this->_view->descripcion = 'Muestra la información de clientes y pasajeros';
        $this->_view->icono = 'gi gi-parents';

        $this->_view->datos = $this->_pasajeros->getPasajeroPorId($id);

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('cedula')){
                $this->_view->_error = 'Debe introducir el cedula de Identidad';
                $this->_view->renderizar('editar', 'pasajeros');
                exit;
            }

            /*if($this->_pasajeros->verificarPasajero($this->getPostParam('cedula'))){
                $this->_view->_error = 'Esta cedula ya se encuentra registrado';
                $this->_view->renderizar('editar', 'pasajeros');
                exit;
            }*/

            if(!$this->getPostParam('nombres')){
                $this->_view->_error = 'Debe introducir un nombre';
                $this->_view->renderizar('editar', 'pasajeros');
                exit;
            }

            if(!$this->getPostParam('apellidos')){
                $this->_view->_error = 'Debe introducir al menos un apellido';
                $this->_view->renderizar('editar', 'pasajeros');
                exit;
            }

            $verificar = $this->_pasajeros->updatePasajero(
                    $id,
                    $this->getPostParam('cedula'),
                    $this->getPostParam('nombres'),
                    $this->getPostParam('apellidos'),
                    $this->getPostParam('direccion'),
                    $this->getPostParam('telefono')
                    );

            if(!$verificar){
                $this->_view->_error = 'Error al actualizar';
                $this->_view->renderizar('editar', 'pasajeros');
                exit;
            }

             $this->redireccionar('pasajeros');
        }    

        $this->_view->renderizar('editar', 'pasajeros');
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