<?php

class aclController extends Controller
{
    private $_aclm;
    
    public function __construct() 
    {
        parent::__construct();
        $this->_aclm = $this->loadModel('acl');
        $this->_view->setJs(array('acl')); 
    }
    
    public function index()
    {
        $this->_view->titulo = 'Listas de acceso';
        $this->_view->descripcion = 'Define roles, permisos y acceso al sistema';
        $this->_view->icono = 'gi gi-folder_lock';

        $this->_view->roles = $this->_aclm->getRoles();
        $this->_view->permisos_roles = $this->_aclm->getPermisosRoles();
        $this->_view->modulos = $this->_aclm->getModulos();
        $this->_view->renderizar('index', 'acl');
    }
    
    public function roles()
    {
        $this->_view->titulo = 'Administracion de roles';
        $this->_view->descripcion = 'Define roles, permisos y acceso al sistema';
        $this->_view->icono = 'gi gi-folder_lock';
        $this->_view->roles = $this->_aclm->getRoles();
        $this->_view->renderizar('roles', 'acl');
    }

    public function getRoles()
    {
        echo json_encode($this->_aclm->getRoles());
    }

    public function crear_rol()
    {
        if($this->getSql('rol')){
            $idRol = $this->_aclm->setRol(
                        $this->getSql('rol')
                        );
        }

        $permisos = $this->_aclm->getPermisos();

        for ($i=0; $i < count($permisos) ; $i++) { 
            $this->_aclm->setPermisoRol($idRol, $permisos[$i]['id']);
        }

    }

    public function crear_permiso()
    {
        if($this->getPostParam('modulo')){
            $idPermiso = $this->_aclm->setPermiso(
                        $this->getPostParam('permiso'),
                        $this->getPostParam('key'),
                        $this->getPostParam('modulo')
                        );
        }

        $roles = $this->_aclm->getRoles();

        for ($i=0; $i < count($roles) ; $i++) { 
            $this->_aclm->setPermisoRol($roles[$i]['id'], $idPermiso);
        }

    }


       
    public function permisos_rol($idRol)
    {
        $id = $this->filtrarInt($idRol);
        
        if(!$id){
            $this->redireccionar('acl/roles');
        }
        
        $row = $this->_aclm->getRol($id);
        
        if(!$row){
            $this->redireccionar('acl/roles');
        }
        
        $this->_view->titulo = 'Administracion de permisos rol';
        
        if($this->getInt('guardar') == 1){

            $permisos = $this->_aclm->getPermisos();

            foreach ($permisos as $perm) {
                $this->_aclm->updatePermisoRol(
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

            $this->redireccionar('acl');

        }
        
        $this->_view->rol = $row;
        $this->_view->permisos = $this->_aclm->getPermisosRol($id);
        $this->_view->renderizar('permisos_rol', 'acl');
    }
    
    public function permisos()
    {
        $this->_view->titulo = 'Administracion de permisos';
        $this->_view->permisos = $this->_aclm->getPermisos();
        $this->_view->renderizar('permisos', 'acl');
    }
        
}
?>
