<?php

class planillaModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getPlanillas()
    {
		$planillas = $this->_db->query("SELECT
										planillas.id as 'id_planilla',
										planillas.*,
										empleados.*,
										automotor.*,
										recorridos.*
										FROM
										planillas
										INNER JOIN planilla_conductores ON planillas.id = planilla_conductores.id_planillas
										INNER JOIN empleados ON empleados.id = planilla_conductores.id_empleados
										INNER JOIN automotor ON automotor.id = planillas.id_automotor
										INNER JOIN recorridos ON recorridos.id = planillas.id_recorridos
										");
        return $planillas->fetchall();
    }
    
    public function getConsecutivo()
    {
		$consecutivo = $this->_db->query("SELECT contrato FROM planillas ORDER BY contrato DESC  LIMIT 1");
        return $consecutivo->fetch();
    }

    public function setPlanilla($contrato, $id_automotor, $consec_transito, $fec_inicial, $fec_final, $id_recorridos, $convenio, $contratante)
    {
        $sql="INSERT INTO `planillas` VALUES (NULL, '$contrato', '$id_automotor', '$consec_transito', '$fec_inicial', '$fec_final', '$id_recorridos', '$convenio', 'CURRENT_TIMESTAMP()', '$contratante');";
        $this->_db->query($sql);

        return $this->_db->lastInsertId();
    }

    public function setConductor($idPlanilla, $idConductor)
    {
        $sql="INSERT INTO `planilla_conductores` VALUES (NULL, '$idPlanilla', '$idConductor');";        
        return $this->_db->query($sql);
    }

    public function setPasajero($idPlanilla, $idPasajero)
    {
        $sql="INSERT INTO `planilla_pasajeros` VALUES (NULL, '$idPlanilla', '$idPasajero');";        
        return $this->_db->query($sql);
    }


    public function setContratante($cedula, $nombres, $apellidos, $direccion, $telefono)
    {
        $sql="INSERT INTO `planillas` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `telefono`) VALUES (NULL, '$cedula', '$nombres', '$apellidos', '$direccion', '$telefono');";
        
        return $this->_db->query($sql);
    }

    public function getConductores()
    {
        $conductores = $this->_db->query("SELECT
										empleados.id,
										empleados.nombres,
										empleados.apellidos,
										empleados.cedula
										FROM
										licencia
										INNER JOIN empleados ON licencia.id_empleados = empleados.id
										WHERE
										licencia.fec_vencimiento >= CURDATE()
										AND licencia.estado = '1'");
        return $conductores->fetchall();
    }

    public function getAutomotores()
    {
        /*$automotores = $this->_db->query("SELECT
										automotor.id,
										automotor.numero,
										automotor.placa,
										automotor.marca,
										automotor.clase,
										automotor.modelo
										FROM
										automotor
										INNER JOIN tarjeta_operacion ON tarjeta_operacion.id_automotor = automotor.id
										INNER JOIN soat ON soat.id_automotor = automotor.id
										WHERE
										tarjeta_operacion.fec_vencimiento >= CURDATE() AND
										soat.fec_vencimiento >= CURDATE()");*/
		$automotores = $this->_db->query("SELECT * FROM automotor ORDER BY numero ASC");
        return $automotores->fetchall();
    }

    public function getRecorridos()
    {
		$recorridos = $this->_db->query("SELECT * FROM recorridos ORDER BY recorrido ASC");
        return $recorridos->fetchall();
    }

    public function getPasajero($cedula)
    {
		$pasajero = $this->_db->query("SELECT
										pasajeros.id,
										pasajeros.cedula,
										pasajeros.nombres,
										pasajeros.apellidos,
										pasajeros.direccion,
										pasajeros.telefono,
										pasajeros.tipo
										FROM
										pasajeros
										WHERE
										pasajeros.cedula = '$cedula'");
        return $pasajero->fetch();
    }

    public function getPasajeros()
    {
		$pasajero = $this->_db->query("SELECT * FROM pasajeros ");
        return $pasajero->fetchall();
    }

    public function getOrigenes()
    {
		$origenes = $this->_db->query("SELECT * FROM recorridos ");
        return $origenes->fetchall();
    }



    public function getDestinos($origen)
    {
		$destinos = $this->_db->query("SELECT
										recorridos.id,
										recorridos.recorrido,
										recorridos.origen,
										recorridos.destino,
										recorridos.valor,
										recorridos.ano
										FROM
										recorridos
										WHERE
										recorridos.origen LIKE '%$origen%'");
        return $destinos->fetchall();
    }

        public function getPlanilla($id)
    {
		$automotor = $this->_db->query("SELECT
										planillas.*,
										automotor.*,
										recorridos.*,
										pasajeros.*,
										empleados.*
										FROM
										planillas
										INNER JOIN automotor ON planillas.id_automotor = automotor.id
										INNER JOIN recorridos ON planillas.id_recorridos = recorridos.id
										INNER JOIN pasajeros ON planillas.id_contratante = pasajeros.id
										INNER JOIN planilla_conductores ON planilla_conductores.id_planillas = planillas.id
										INNER JOIN empleados ON planilla_conductores.id_empleados = empleados.id
										WHERE
										planillas.id = '$id'
										");
        return $automotor->fetch();
    }

    	public function getLicencia($idEmpleado)
    {
    	$licencia = $this->_db->query("SELECT
										licencia.id,
										licencia.numero,
										licencia.fec_expedicion,
										licencia.fec_vencimiento,
										licencia.estado,
										licencia.id_empleados
										FROM
										licencia
										INNER JOIN empleados ON licencia.id_empleados = empleados.id
										WHERE
										licencia.estado = '1' AND
										licencia.fec_vencimiento >= 'CURDATE()' AND
										licencia.id_empleados = '$idEmpleado'
										");
    	return $licencia->fetch();
    }

    public function getPasajeroPorId($id)
    {
        $pasajero = $this->_db->query("SELECT * FROM pasajeros WHERE id='$id'");
        return $pasajero->fetch();
    }
}

?>
