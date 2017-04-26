<?php

class automotorModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function setAutomotor($numero, $placa, $marca, $clase, $modelo)
    {
        $sql = "INSERT INTO `automotor` (`id`, `numero`, `placa`, `marca`, `clase`, `modelo`) VALUES (NULL, '$numero', '$placa', '$marca', '$clase', '$modelo');";
        
        return $this->_db->query($sql);
    }

    public function updateAutomotor($id, $numero, $placa, $marca, $clase, $modelo)
    {
        $sql = "UPDATE `automotor` SET `numero` = '$numero', `placa` = '$placa', `marca` = '$marca', `clase` = '$clase', `modelo` = '$modelo' WHERE `automotor`.`id` = '$id';";
        
        return $this->_db->query($sql);
    }

    public function getAutomotores()
    {
        $automotor = $this->_db->query("SELECT * FROM automotor ORDER BY numero ASC");
        return $automotor->fetchall();
    }

    public function getAutomotorPorId($id)
    {
        $automotor = $this->_db->query("SELECT * FROM automotor WHERE id='$id'");
        return $automotor->fetch();
    }

    public function getSoatPorAutomotor($id)
    {
        $soat = $this->_db->query("SELECT
                                    automotor.id,
                                    automotor.numero,
                                    automotor.placa,
                                    soat.id,
                                    soat.poliza,
                                    soat.fec_expedicion,
                                    soat.fec_vencimiento,
                                    soat.estado,
                                    aseguradoras.nombre AS aseguradora
                                    FROM
                                    soat
                                    INNER JOIN automotor ON soat.id_automotor = automotor.id
                                    INNER JOIN aseguradoras ON aseguradoras.id = soat.id_aseguradoras
                                    WHERE automotor.id = '$id' 
                                    ORDER BY fec_vencimiento DESC");
        return $soat->fetchall();
    }

    public function getTarjetaPorAutomotor($id)
    {
        $tarjeta = $this->_db->query("SELECT * FROM tarjeta_operacion WHERE id_automotor='$id' ORDER BY fec_vencimiento DESC");
        return $tarjeta->fetchall();
    }

    public function getTecnomecanicasPorAutomotor($id)
    {
        $tecnomecanica = $this->_db->query("SELECT * FROM tecnomecanica WHERE id_automotor='$id' ORDER BY fec_vencimiento DESC");
        return $tecnomecanica->fetchall();
    }
    
}

?>