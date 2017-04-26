<?php

class tarjeta_operacionModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getTarjetas()
    {
        $tarjetas = $this->_db->query("SELECT tarjeta_operacion.*, automotor.numero, automotor.placa FROM tarjeta_operacion
                                    INNER JOIN automotor ON tarjeta_operacion.id_automotor = automotor.id ORDER BY automotor.numero ASC");

        return $tarjetas->fetchall();
    }

    public function getAutomotores()
    {
        $automotores = $this->_db->query("SELECT * FROM automotor ORDER BY numero ASC");

        return $automotores->fetchall();
    }

    public function verificarTarjeta($tarjeta)
    {
        $id = $this->_db->query(
                "select id from tarjeta_operacion where tarjeta = '$tarjeta'"
                );
        
        if($id->fetch()){
            return true;
        }
        
        return false;
    }
    
    public function setTarjeta($tarjeta, $capacidad, $fec_expedicion, $fec_vencimiento, $id_automotor, $estado)
    {
        $sql = "INSERT INTO `tarjeta_operacion` VALUES".
                " ('', '$tarjeta', '$capacidad', '$fec_expedicion', '$fec_vencimiento', '$id_automotor', '$estado');";
        
        return $this->_db->query($sql);
    }

    public function updateTarjeta($id, $tarjeta, $capacidad, $fec_expedicion, $fec_vencimiento, $id_automotor)
    {
        $sql = "UPDATE `tarjeta_operacion` SET `tarjeta` = '$tarjeta', `capacidad` = '$capacidad', `fec_expedicion` = '$fec_expedicion', `fec_vencimiento` = '$fec_vencimiento', `id_automotor` = '$id_automotor' WHERE `id` = '$id';";
        
        return $this->_db->query($sql);
    }

    public function getTarjetaPorId($id)
    {
        $tarjeta = $this->_db->query("SELECT * FROM tarjeta_operacion WHERE id='$id'");
        return $tarjeta->fetch();
    }
    
}

?>