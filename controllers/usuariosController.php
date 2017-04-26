<?php

class usuariosController extends Controller
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
        $this->_view->descripcion = 'Define usuarios, permisos y acceso al sistema';
        $this->_view->icono = 'gi gi-folder_lock';
        $this->_view->usuarios = $this->_usuarios->getUsuarios();
        $this->_view->roles = $this->_usuarios->getRoles();
        $this->_view->permisos_roles = $this->_usuarios->getPermisosUsuarios();
        $this->_view->renderizar('index', 'usuarios');
    }

    public function permisos_usuario($idUsuario)
    {
        $id = $this->filtrarInt($idUsuario);
        
        if(!$id){
            $this->redireccionar('usuarios');
        }
        
        $row = $this->_usuarios->getUsuario($id);
        
        if(!$row){
            $this->redireccionar('usuarios');
        }
        
        $this->_view->titulo = 'Administracion de permisos de usuario';
        
        if($this->getInt('guardar') == 1){

            $permisos = $this->_usuarios->getPermisos();

            foreach ($permisos as $perm) {
                $this->_usuarios->updatePermisoRol(
                        $id, 
                        $perm['id'],
                        $this->getPostParam($perm['id'].'ag'),
                        $this->getPostParam($perm['id'].'co'),
                        $this->getPostParam($perm['id'].'mo'),
                        $this->getPostParam($perm['id'].'el'),
                        $this->getPostParam($perm['id'].'im'),
                        $this->getPostParam($perm['id'].'ex')
                        );
            }

            $this->redireccionar('usuarios');

        }
        
        $this->_view->usuario = $row;
        $this->_view->permisos = $this->_usuarios->getPermisosUsuario($id);
        $this->_view->renderizar('permisos_usuario', 'usuarios');
    }

    public function crear_usuario()
    {
       /* if($this->getSql('usuario')){
            $idUsuario = $this->_usuarios->setUsuario(
                        $this->getSql('usuario'),
                        $this->getPostParam('pass'),
                        $this->getPostParam('id_rol')
                        );
        }*/

        $permisos = $this->_usuarios->getPermisos();

        for ($i=0; $i < count($permisos) ; $i++) { 
            return $this->_usuarios->setPermisoUsuario('3', $permisos[$i]['id']);
        }

    }
}

?>
