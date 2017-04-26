<?php
class recorridosModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getRecorridos()
    {
        $tarjetas = $this->_db->query("SELECT * FROM recorridos ORDER BY ano DESC");

        return $tarjetas->fetchall();
    }
    
    public function setRecorrido($recorrido, $origen, $destino, $valor, $ano)
    {
        $sql = "INSERT INTO `recorridos` VALUES".
                " ('', '$recorrido', '$origen', '$destino', '$valor', '$ano');";
        
        return $this->_db->query($sql);
    }

    public function updateRecorrido($id, $recorrido, $origen, $destino, $valor, $ano)
    {
        $sql = "UPDATE `recorridos` SET `recorrido` = '$recorrido', `origen` = '$origen', `destino` = '$destino', `valor` = '$valor', `ano` = '$ano' WHERE `id` = '$id';";
        
        return $this->_db->query($sql);
    }

    public function getRecorridoPorId($id)
    {
        $recorrido = $this->_db->query("SELECT * FROM recorridos WHERE id='$id'");
        return $recorrido->fetch();
    }
    
}

?>