<?php

class pasajerosModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function setPasajero($cedula, $nombres, $apellidos, $direccion, $telefono)
    {
        $sql = "INSERT INTO `pasajeros` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `telefono`, `tipo`) VALUES (NULL, '$cedula', '$nombres', '$apellidos', '$direccion', '$telefono', '1');";
        
        return $this->_db->query($sql);
    }

    public function getPasajeros()
    {
        $pasajeros = $this->_db->query("SELECT * FROM pasajeros");
        return $pasajeros->fetchall();
    }

    public function verificarPasajero($cedula)
    {
        $pasajero = $this->_db->query("SELECT * FROM pasajeros WHERE cedula = '$cedula'");
        return $pasajero->fetch();
    }

    public function getPasajeroPorId($id)
    {
        $pasajero = $this->_db->query("SELECT * FROM pasajeros WHERE id='$id'");
        return $pasajero->fetch();
    }

    public function updatePasajero($id, $cedula, $nombres, $apellidos, $direccion, $telefono)
    {
        $sql = "UPDATE `pasajeros` SET `cedula` = '$cedula', `nombres` = '$nombres', `apellidos` = '$apellidos', `direccion` = '$direccion', `telefono` = '$telefono' WHERE `id` = '$id';";
        
        return $this->_db->query($sql);
    }

}

?>