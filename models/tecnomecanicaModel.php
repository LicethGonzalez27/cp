<?php

class tecnomecanicaModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getTecnomecanicas()
    {
        $tecnomecanica = $this->_db->query("SELECT * FROM  `tecnomecanica` INNER JOIN automotor ON tecnomecanica.id_automotor = automotor.id");
        return $tecnomecanica->fetchall();
    }


    public function getAutomotores()
    {
        $automotores = $this->_db->query("SELECT * FROM automotor ORDER BY numero ASC");

        return $automotores->fetchall();
    }


    public function setTecnomecanica($consecutivo, $fec_expedicion, $fec_vencimiento, $id_automotor, $estado)
    {
        $sql="INSERT INTO `tecnomecanica` (`id`, `consecutivo`, `fec_expedicion`, `fec_vencimiento`, `id_automotor`, `estado`) VALUES (NULL, '$consecutivo', '$fec_expedicion', '$fec_vencimiento', '$id_automotor', '$estado');";
        
        return $this->_db->query($sql);
    }

    public function getTecnomecanicasActivasPorAutomotor($id)
    {
        $tecnomecanica = $this->_db->query("SELECT * FROM  tecnomecanica WHERE id_automotor = '$id' AND estado = '1' ORDER BY fec_vencimiento ASC");
        return $tecnomecanica->fetchall();
    }

    public function updateEstadoTecnomecanica($id, $estado)
    {
        $sql="UPDATE `tecnomecanica` SET `estado` = '$estado' WHERE `id` = '$id';";
        
        return $this->_db->query($sql);
    }






    public function setAseguradora($nombre, $telefonos)
    {
        $sql="INSERT INTO `aseguradoras` VALUES (NULL, '$nombre', '$telefonos');";
        
        return $this->_db->query($sql);
    }   

    public function updateSoat($id, $poliza, $fec_expedicion, $fec_vencimiento, $id_automotor, $id_aseguradoras)
    {
        $sql="UPDATE `soat` SET `poliza` = '$poliza', `fec_expedicion` = '$fec_expedicion', `fec_vencimiento` = '$fec_vencimiento', `id_automotor` = '$id_automotor', `id_aseguradoras` = '$id_aseguradoras' WHERE `id` = '$id';";
        
        return $this->_db->query($sql);
    }

    public function gettecnomecanica()
    {
		$soat = $this->_db->query("SELECT
									automotor.numero,
									automotor.placa,
									soat.id,
									soat.poliza,
									soat.fec_expedicion,
									soat.fec_vencimiento,
									aseguradoras.nombre AS aseguradora
									FROM
									soat
									INNER JOIN automotor ON soat.id_automotor = automotor.id
									INNER JOIN aseguradoras ON aseguradoras.id = soat.id_aseguradoras 
									ORDER BY fec_vencimiento DESC");
        return $soat->fetchall();
    }

    public function getSoatPorID($id)
    {
		$soat = $this->_db->query("SELECT
									automotor.numero,
									automotor.placa,
									soat.id,
									soat.poliza,
									soat.fec_expedicion,
									soat.fec_vencimiento,
									soat.id_aseguradoras,
									aseguradoras.nombre AS aseguradora
									FROM
									soat
									INNER JOIN automotor ON soat.id_automotor = automotor.id
									INNER JOIN aseguradoras ON aseguradoras.id = soat.id_aseguradoras
									WHERE soat.id = '$id' 
									ORDER BY fec_vencimiento DESC");
        return $soat->fetch();
    }   

    


    public function verificarPoliza($poliza)
    {
        $id = $this->_db->query(
                "select id from soat where poliza = '$poliza'"
                );
        
        if($id->fetch()){
            return true;
        }
        
        return false;
    }
}

?>
