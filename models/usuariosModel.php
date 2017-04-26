<?php

class usuariosModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setUsuario($usuario, $pass, $id_rol)
    {
        $passEn = Hash::getHash('sha1', $pass, HASH_KEY);

        $sql = "INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `id_rol`, `estado`) VALUES (NULL, '$usuario', '$passEn', '$id_rol', '1')";

        $this->_db->query($sql);

        return $this->_db->lastInsertId();
    }
    
    public function getUsuario($idUsuario)
    {
        $idUsuario = (int) $idUsuario;
        
        $usuario = $this->_db->query("SELECT * FROM usuarios WHERE id = '$idUsuario'");
        return $usuario->fetch();
    }

    public function getUsuarios()
    {
        $usuarios = $this->_db->query(
                "SELECT * FROM usuarios"
                );
        return $usuarios->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoles()
    {
        $roles = $this->_db->query("SELECT * FROM rol");
        
        return $roles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermisos()
    {
        $permisos = $this->_db->query("SELECT * FROM `permisos`");
                        
        return $permisos->fetchAll();
    }

    public function getPermisosUsuarios()
    {
        $data = array();
        $usuarios = $this->getUsuarios();

        for ($i=0; $i < count($usuarios); $i++) { 
            $data[$usuarios[$i]['id']] = $this->getPermisosUsuario($usuarios[$i]['id']);
        }

        return $data;
    }

    public function getPermisosUsuario($idUsuario)
    {
        $permisos = $this->_db->query(
                "SELECT
                  *
                FROM
                  permisos_usuarios
                  INNER JOIN permisos ON permisos.id = permisos_usuarios.id_permisos 
                  INNER JOIN modulos ON modulos.id = permisos.id_modulos 
                WHERE
                  id_usuarios = '$idUsuario'"
                );
                
        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);

        return $permisos;
    }
    
    public function setPermisoUsuario($idUsuario, $idPermiso)
    {
        $this->_db->query("REPLACE INTO `permisos_usuarios` VALUES ('3', '$idPermiso', '0', '0', '0', '0', '0', '0')");
    }

    public function updatePermisoRol($idUsuario, $idPermiso, $agregar, $consultar, $modificar, $eliminar, $imprimir, $exportar)
    {
        $this->_db->query(
                "UPDATE `permisos_usuarios` SET `agregar` = '$agregar', `consultar` = '$consultar', `modificar` = '$modificar', `eliminar` = '$eliminar', `imprimir` = '$imprimir', `exportar` = '$exportar' WHERE `id_usuarios` = '$idUsuario' AND `id_permisos` = '$idPermiso' ;"
                );
    }
}

?>
