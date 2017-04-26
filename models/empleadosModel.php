<?php

class empleadosModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function setEmpleado($nombres, $apellidos, $cedula, $fec_nacimiento, $direccion, $telefono)
    {
        $sql = "INSERT INTO `empleados` VALUES ('', '$nombres', '$apellidos', '$cedula', '$fec_nacimiento', '$direccion', '$telefono');";
        
        $this->_db->query($sql);

        return $this->_db->lastInsertId();
    }

    public function getEmpleados()
    {
        $empleados = $this->_db->query("SELECT * FROM empleados");
        return $empleados->fetchall();
    }

    public function getEmpleadosUsuarios()
    {
        $empleados = $this->_db->query("SELECT
                                        empleados.id,
                                        empleados.nombres,
                                        empleados.apellidos,
                                        empleados.cedula,
                                        empleados.fec_nacimiento,
                                        empleados.direccion,
                                        empleados.telefono,
                                        usuarios.usuario,
                                        rol.rol
                                        FROM
                                        empleados
                                        INNER JOIN usuarios ON usuarios.id_empleados = empleados.id
                                        INNER JOIN rol ON usuarios.id_rol = rol.id
                                        GROUP BY usuarios.id_empleados
                                        ORDER BY empleados.apellidos ASC");
        return $empleados->fetchall();
    }

    public function getEmpleadosConductores()
    {
        $empleados = $this->_db->query("SELECT
                                        empleados.id,
                                        empleados.nombres,
                                        empleados.apellidos,
                                        empleados.cedula,
                                        empleados.fec_nacimiento,
                                        empleados.direccion,
                                        empleados.telefono,
                                        licencia.numero,
                                        licencia.fec_expedicion,
                                        licencia.fec_vencimiento,
                                        licencia.estado
                                        FROM
                                        empleados
                                        INNER JOIN licencia ON licencia.id_empleados = empleados.id
                                        GROUP BY licencia.id_empleados 
                                        ORDER BY empleados.apellidos ASC");
        return $empleados->fetchall();
    }

    public function verificarEmpleado($documento)
    {
        $pasajero = $this->_db->query("SELECT * FROM empleados WHERE cedula = '$documento'");
        return $pasajero->fetch();
    }

    public function setUsuario($usuario, $pass, $id_rol, $id_empleado)
    {
        $passEn = Hash::getHash('sha1', $pass, HASH_KEY);

        $sql = "INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `id_rol`, `id_empleados`, `estado`) VALUES (NULL, '$usuario', '$passEn', '$id_rol', '$id_empleado', '1')";
        
        return $this->_db->query($sql);
    }

    public function setLicencia($numero, $fec_expedicion, $fec_vencimiento, $id_empleado)
    {
        $sql = "INSERT INTO `licencia` (`id`, `numero`, `fec_expedicion`, `fec_vencimiento`, `estado`, `id_empleados`) VALUES ('', '$numero', '$fec_expedicion', '$fec_vencimiento', '1', '$id_empleado');";
        
        return $this->_db->query($sql);
    }
    
}

?>