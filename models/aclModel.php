<?php

class aclModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getRol($idRol)
    {
        $idRol = (int) $idRol;
        
        $rol = $this->_db->query("SELECT * FROM rol WHERE id = '$idRol'");
        return $rol->fetch();
    }
    
    public function getRoles()
    {
        $roles = $this->_db->query("SELECT * FROM rol");
        
        return $roles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getModulos()
    {
        $modulos = $this->_db->query("SELECT * FROM modulos");
        
        return $modulos->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermisos()
    {
        $permisos = $this->_db->query("SELECT * FROM permisos");
                        
        return $permisos->fetchAll(PDO::FETCH_ASSOC);;
    }

    public function getPermisosRoles()
    {
        $data = array();
        $roles = $this->getRoles();

        for ($i=0; $i < count($roles); $i++) { 
            $data[$roles[$i]['id']] = $this->getPermisosRol($roles[$i]['id']);
        }

        return $data;
    }
    
    public function getPermisosRol($idRol)
    {
        $data = array();
        
        $permisos = $this->_db->query(
                "SELECT
                  *
                FROM
                  permisos_roles
                  INNER JOIN permisos ON permisos.id = permisos_roles.id_permisos 
                  INNER JOIN modulos ON modulos.id = permisos.id_modulos 
                WHERE
                  id_rol = '$idRol'"
                );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);

        return $permisos;
    }
    
    public function getPermisoKey($idPermiso)
    {
        $idPermiso = (int) $idPermiso;
        
        $key = $this->_db->query(
                "SELECT `key` FROM permisos WHERE id = $idPermiso"
                );
        
        $key = $key->fetch();
        return $key['key'];
    }
    
    public function getPermisoNombre($idPermiso)
    {
        $idPermiso = (int) $idPermiso;
        
        $key = $this->_db->query(
                "SELECT permiso FROM permisos WHERE id_permiso = $idPermiso"
                );
        
        $key = $key->fetch();
        return $key['permiso'];
    }
    
    public function getPermisosAll()
    {
        $permisos = $this->_db->query(
                "SELECT * FROM permisos"
                );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        
        for($i = 0; $i < count($permisos); $i++){
            $data[$permisos[$i]['key']] = array(
                'key' => $permisos[$i]['key'],
                'valor' => 'x',
                'nombre' => $permisos[$i]['permiso'],
                'id' => $permisos[$i]['id']
            );
        }
        
        return $data;
    }
    
    public function setRol($rol)
    {
        $this->_db->query("INSERT INTO rol VALUES(null, '$rol')");

        return $this->_db->lastInsertId();
    }

    public function setPermiso($permiso, $key, $idModulo)
    {
        $this->_db->query(
                "INSERT INTO `permisos` VALUES (NULL, '$permiso', '$key', '$idModulo');" );

        return $this->_db->lastInsertId();
    }

    public function setPermisoRol($idRol, $idPermiso)
    {
        $this->_db->query("INSERT INTO `permisos_roles` VALUES ('$idRol', '$idPermiso', '0', '0', '0', '0', '0', '0')");
    }

    public function updatePermisoRol($idRol, $idPermiso, $agregar, $consultar, $modificar, $eliminar, $imprimir, $exportar)
    {
        $this->_db->query(
                "UPDATE `permisos_roles` SET `agregar` = '$agregar', `consultar` = '$consultar', `modificar` = '$modificar', `eliminar` = '$eliminar', `imprimir` = '$imprimir', `exportar` = '$exportar' WHERE `id_rol` = '$idRol' AND `id_permisos` = '$idPermiso' ;"
                );
    }
    
    public function eliminarPermisoRole($idRol, $idPermiso)
    {
        $this->_db->query(
                "DELETE FROM permisos_role " . 
                "WHERE permiso = {$idPermiso} " .
                "AND role = {$idRol}"
                );
    }

    public function editarPermisoRole($idRol, $idPermiso, $valor)
    {
        $this->_db->query(
                "replace into permisos_role set role = {$idRol}, permiso = {$idPermiso}, valor = '{$valor}'"
                );
    }

    public function insertarPermiso($permiso, $llave)
    {
        $this->_db->query(
                "INSERT INTO permisos VALUES" .
                "(null, '{$permiso}', '{$llave}')"
                );
    }
}

?>
