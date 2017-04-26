<?php

class loginController extends Controller
{
    private $_login;
    
    public function __construct(){
        parent::__construct();
        $this->_login = $this->loadModel('login');
    }
    
    public function index()
    {
        if(Session::get('autenticado')){
            $this->redireccionar();
        }
        
        $this->_view->titulo = 'Iniciar Sesion';
        $this->_view->setCss(array('login'));
        
        if($this->getInt('enviar') == 1){
            $this->_view->datos = $_POST;
            
            if(!$this->getPostParam('login-user')){
                $this->_view->_error = 'Debe introducir su nombre de usuario';
                $this->_view->renderizar('index','login');
                exit;
            }
            
            if(!$this->getPostParam('login-password')){
                $this->_view->_error = 'Debe introducir su password';
                $this->_view->renderizar('index','login');
                exit;
            }
            
            $row = $this->_login->getUsuario(
                    $this->getPostParam('login-user'),
                    $this->getPostParam('login-password')
                    );
            
            if(!$row){
                $this->_view->_error = 'Usuario y/o password incorrectos';
                $this->_view->renderizar('index','login');
                exit;
            }
            
            if($row['estado'] != 1){
                $this->_view->_error = 'Este usuario no esta habilitado';
                $this->_view->renderizar('index','login');
                exit;
            }
                        
            Session::set('autenticado', true);
            Session::set('level', $row['role']);
            Session::set('nombre_usuario', $row['nombres']);
            Session::set('id_usuario', $row['id']);
            Session::set('tiempo', time());
            
            $this->redireccionar();
        }
        
        $this->_view->renderizar('index','login');
        
    }
    
    public function cerrar()
    {
        Session::destroy();
        $this->redireccionar();
    }
}

?>
