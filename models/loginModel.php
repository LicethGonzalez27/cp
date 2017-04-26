<?php

class loginModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getUsuario($usuario, $password)
    {
        $datos = $this->_db->query(
                "SELECT
                    empleados.id,
                    empleados.nombres,
                    empleados.apellidos,
                    rol.rol,
                    usuarios.usuario,
                    usuarios.estado
                FROM
                usuarios
                INNER JOIN empleados ON usuarios.id_empleados = empleados.id
                INNER JOIN rol ON usuarios.id_rol = rol.id
                WHERE " .
                "usuarios.usuario = '$usuario' " .
                "and usuarios.pass = '" . Hash::getHash('sha1', $password, HASH_KEY) ."'"
                );
        
        return $datos->fetch();
    }
}

?>
