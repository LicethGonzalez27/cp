<?php

class indexController extends usuariosController
{
    private $_usuarios;
    
    public function __construct() 
    {
        parent::__construct();
        $this->_usuarios = $this->loadModel('usuarios');
        $this->_view->setJs(array('usuarios'));
    }
    
    public function index()
    {
        $this->_view->titulo = 'Usuarios';
        $this->_view->descripcion = 'Define roles, permisos y acceso al sistema';
        $this->_view->icono = 'gi gi-folder_lock';
        $this->_view->usuarios = $this->_usuarios->getUsuarios();
        $this->_view->roles = $this->_usuarios->getRoles();
        $this->_view->renderizar('index', 'usuarios');
    }

    public function crear_usuario()
    {
        if($this->getSql('usuario')){
            $idUsuario = $this->_usuarios->setUsuario(
                        $this->getSql('usuario'),
                        $this->getPostParam('pass'),
                        $this->getPostParam('idRol')
                        );
        }

        $permisos = $this->_aclm->getPermisos();

        for ($i=0; $i < count($permisos) ; $i++) { 
            $this->_aclm->setPermisoRol($idUsuario, $permisos[$i]['id']);
        }

    }
    
    
}

?>
