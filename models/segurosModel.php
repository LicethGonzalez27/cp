<?php

class segurosModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function setAseguradora($nombre, $telefonos)
    {
        $sql="INSERT INTO `aseguradoras` VALUES (NULL, '$nombre', '$telefonos');";
        
        return $this->_db->query($sql);
    }   
    
    public function setSoat($poliza, $fec_expedicion, $fec_vencimiento, $id_automotor, $id_aseguradoras)
    {
        $sql="INSERT INTO `soat` VALUES (NULL, '$poliza', '$fec_expedicion', '$fec_vencimiento', '$id_automotor', '$id_aseguradoras', '1');";
        
        return $this->_db->query($sql);
    }

    public function updateSoat($id, $poliza, $fec_expedicion, $fec_vencimiento, $id_automotor, $id_aseguradoras)
    {
        $sql="UPDATE `soat` SET `poliza` = '$poliza', `fec_expedicion` = '$fec_expedicion', `fec_vencimiento` = '$fec_vencimiento', `id_automotor` = '$id_automotor', `id_aseguradoras` = '$id_aseguradoras' WHERE `id` = '$id';";
        
        return $this->_db->query($sql);
    }

    public function getSoat()
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

    public function getAseguradoras()
    {
		$aseguradoras = $this->_db->query("SELECT * FROM aseguradoras ORDER BY nombre ASC");
        return $aseguradoras->fetchall();
    }

    public function getAutomotores()
    {
		$automotores = $this->_db->query("SELECT * FROM automotor ORDER BY numero ASC");

        return $automotores->fetchall();
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
