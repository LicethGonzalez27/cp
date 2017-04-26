<?php

class empleadosController extends Controller
{
    private $_empleados;

    public function __construct() {
        parent::__construct();
        $this->_empleados = $this->loadModel('empleados');
        $this->_view->setJs(array('empleados'));
    }
    
    public function index()
    {
        $this->_view->titulo = 'Empleados';
        $this->_view->descripcion = 'Muestra toda la información correspondiente al personal de la empresa';
        $this->_view->icono = 'gi gi-parents';
        $this->_view->empleados = $this->_empleados->getEmpleados();
        $this->_view->usuarios = $this->_empleados->getEmpleadosUsuarios();
        $this->_view->conductores = $this->_empleados->getEmpleadosConductores();
        $this->_view->renderizar('index', 'empleados');
    }

    public function nuevo()
    {
        $this->_view->titulo = 'Empleados';
        $this->_view->descripcion = 'Muestra toda la información correspondiente al personal de la empresa';
        $this->_view->icono = 'gi gi-parents';
        
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('documento')){
                $this->_view->_error = 'Debe introducir el Documento de Identidad';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if($this->_empleados->verificarEmpleado($this->getPostParam('documento'))){
                $this->_view->_error = 'Este documento ya se encuentra registrado';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if(!$this->getPostParam('nombres')){
                $this->_view->_error = 'Debe introducir un nombre';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if(!$this->getPostParam('apellidos')){
                $this->_view->_error = 'Debe introducir al menos un apellido';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if(!$this->getPostParam('fec_nacimiento')){
                $this->_view->_error = 'Debe introducir la fecha de nacimiento';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if(!$this->getPostParam('direccion')){
                $this->_view->_error = 'Debe introducir una direccion';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if(!$this->getPostParam('telefono')){
                $this->_view->_error = 'Debe introducir un telefono';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if ($this->getPostParam('tipoUsuario') == '1') {

                if(!$this->getPostParam('pass')){
                    $this->_view->_error = 'Debe introducir su password';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }
                
                if($this->getPostParam('pass') != $this->getPostParam('confirmar')){
                    $this->_view->_error = 'Los passwords no coinciden';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }

                if($this->getPostParam('rol') == 0){
                    $this->_view->_error = 'Debe seleccionar un rol de usuario';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }

            }elseif ($this->getPostParam('tipoUsuario') == '2') {
                
                if(!$this->getPostParam('licencia')){
                    $this->_view->_error = 'Debe introducir el numero de licencia';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }

                if(!$this->getPostParam('fec_expedicion')){
                    $this->_view->_error = 'Debe introducir el numero de licencia';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }

                if(!$this->getPostParam('fec_vencimiento')){
                    $this->_view->_error = 'Debe introducir el numero de licencia';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }

                if($this->getPostParam('fec_vencimiento') < $this->getPostParam('fec_expedicion')){
                    $this->_view->_error = 'La fecha de vencimiento no puede ser anterior a la de expedicion';
                    $this->_view->renderizar('nuevo', 'empleados');
                    exit;
                }

            }else{
                $this->_view->_error = 'Debe seleccionar un tipo de usuario';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            $lastInsertId =$this->_empleados->setEmpleado(
                    $this->getPostParam('nombres'),
                    $this->getPostParam('apellidos'),
                    $this->getPostParam('documento'),
                    $this->getPostParam('fec_nacimiento'),
                    $this->getPostParam('direccion'),
                    $this->getPostParam('telefono')
                    );

            if(!$lastInsertId){
                $this->_view->_error = 'Error al registrar';
                $this->_view->renderizar('nuevo', 'empleados');
                exit;
            }

            if ($this->getPostParam('tipoUsuario') == '1') {
                $this->_empleados->setUsuario(
                    $this->getPostParam('documento'),
                    $this->getPostParam('pass'),
                    $this->getPostParam('rol'),
                    $lastInsertId
                    );
            }else if ($this->getPostParam('tipoUsuario') == '2') {
                $this->_empleados->setLicencia(
                    $this->getPostParam('licencia'),
                    $this->getPostParam('fec_expedicion'),
                    $this->getPostParam('fec_vencimiento'),
                    $lastInsertId
                    );
            }


             $this->redireccionar('empleados');
        }    

        $this->_view->renderizar('nuevo', 'empleados');
    }
}

?>