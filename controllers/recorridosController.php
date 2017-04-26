<?php

class recorridosController extends Controller
{
	private $_recorridos;

    public function __construct() {
        parent::__construct();
        $this->_recorridos = $this->loadModel('recorridos');

    }
    
    public function index()
    {       
        $this->_view->recorridos = $this->_recorridos->getRecorridos();
        $this->_view->titulo = 'Recorridos';
        $this->_view->descripcion = 'Permite crear y consultar recorridos';
        $this->_view->icono = 'hi hi-road';

        $this->_view->renderizar('index', 'recorridos');
    }

    public function nuevo()
    {
              
        $this->_view->titulo = 'Recorrido - Nuevo';
        $this->_view->descripcion = 'Permite crear recorridos';
        $this->_view->icono = 'hi hi-road';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('recorrido')){
                $this->_view->_error = 'Debe ingresar el recorrido';
                $this->_view->renderizar('nuevo', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('origen')){
                $this->_view->_error = 'Debe ingresar la ciudad de origen';
                $this->_view->renderizar('nuevo', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('destino')){
                $this->_view->_error = 'Debe ingresar la ciudad de destino';
                $this->_view->renderizar('nuevo', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('valor')){
                $this->_view->_error = 'Debe introducir una tarifa';
                $this->_view->renderizar('nuevo', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('ano')){
                $this->_view->_error = 'Año de la tarifa';
                $this->_view->renderizar('nuevo', 'recorridos');
                exit;
            }

            $this->_recorridos->setRecorrido(
                    $this->getPostParam('recorrido'),
                    $this->getPostParam('origen'),
                    $this->getPostParam('destino'),
                    $this->getPostParam('valor'),
                    $this->getPostParam('ano')
                    );

            $this->redireccionar('recorridos');
        }    

        $this->_view->renderizar('nuevo', 'recorridos');
    }

    public function editar($id = false)
    {
        if ($id == false) {
            $this->redireccionar('recorridos');
        }

        $comparacion =  $this->_recorridos->getRecorridoPorId($id);
        $this->_view->datos = $comparacion;

        $this->_view->titulo = 'Recorrido - Nuevo';
        $this->_view->descripcion = 'Permite modificar recorridos';
        $this->_view->icono = 'hi hi-road';

        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('recorrido')){
                $this->_view->_error = 'Debe ingresar el recorrido';
                $this->_view->renderizar('editar', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('origen')){
                $this->_view->_error = 'Debe ingresar la ciudad de origen';
                $this->_view->renderizar('editar', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('destino')){
                $this->_view->_error = 'Debe ingresar la ciudad de destino';
                $this->_view->renderizar('editar', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('valor')){
                $this->_view->_error = 'Debe introducir una tarifa';
                $this->_view->renderizar('editar', 'recorridos');
                exit;
            }

            if(!$this->getPostParam('ano')){
                $this->_view->_error = 'Año de la tarifa';
                $this->_view->renderizar('editar', 'recorridos');
                exit;
            }

            $this->_recorridos->updateRecorrido(
                    $id,
                    $this->getPostParam('recorrido'),
                    $this->getPostParam('origen'),
                    $this->getPostParam('destino'),
                    $this->getPostParam('valor'),
                    $this->getPostParam('ano')
                    );

            $this->redireccionar('recorridos');
        }    

        $this->_view->renderizar('editar', 'recorridos');
    }
}
?>
