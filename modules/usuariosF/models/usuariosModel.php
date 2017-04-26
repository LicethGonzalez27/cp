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
    
    public function setPermisoUsuario($idUsuario, $idPermiso)
    {
        $this->_db->query("INSERT INTO `permisos_usuarios` VALUES ('$idRol', '$idPermiso', '0', '0', '0', '0', '0', '0')");
    }
}

?>
