<?php

class indexController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->_general = $this->loadModel('general');
    }
    
    public function index()
    {
        if(!Session::get('autenticado')){
            $this->redireccionar('login');
        }
        
        $this->_view->titulo = 'Portada';

        $this->_view->estadisticas = $this->_general->getStats();
        $this->_view->registros = $this->_general->getRegistros();

        $this->_view->renderizar('index', 'index');
    }
}

?>