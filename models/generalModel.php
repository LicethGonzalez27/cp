<?php

class generalModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getBadges()
    {
        $badges = array(
                't_operacion' => $this->getNumTarjetasOperacionPorVencer(),
                'soat' => $this->getNumSoatPorVencer(),
                'tecnomecanica' => $this->getNumTecnomecanicaPorVencer(),
                'licencia' => $this->getNumLicenciaPorVencer()
        );
        return $badges;
    }

    public function getStats()
    {
        $stats = array(
                'planillas' => $this->getNumPlanillas(),
                'pasajeros' => $this->getNumPasajeros(),
                'automotoresTrabajando' => $this->getNumAutomotoresDisponibles(),
                'planillasHoy' => $this->getNumPlanillasHoy()
        );
        return $stats;
    }

    public function getRegistros()
    {
        $stats = array(
                'planillas' => $this->getNumPlanillas(),
                'pasajeros' => $this->getNumPasajeros(),
                'recorridos' => $this->getNumRecorridos(),
                'automotores' => $this->getNumAutomotores(),
                't_operacion' => $this->getNumTarjetasOperacion(),
                'soat' => $this->getNumSoat(),
                'tecnomecanica' => $this->getNumTecnomecanica()
        );
        return $stats;
    }

    public function getNumTarjetasOperacionPorVencer()
    {
        $tarjetas = $this->_db->query("SELECT * FROM tarjeta_operacion
                                        WHERE DATEDIFF(fec_vencimiento,CURDATE()) <= '30' AND estado = '1'");

        return count($tarjetas->fetchall());
    }

    public function getNumSoatPorVencer()
    {
        $soat = $this->_db->query("SELECT * FROM soat
                                        WHERE DATEDIFF(fec_vencimiento,CURDATE()) <= '30' AND estado = '1'");

        return count($soat->fetchall());
    }

    public function getNumTecnomecanicaPorVencer()
    {
        $tecnomecanica = $this->_db->query("SELECT * FROM tecnomecanica
                                        WHERE DATEDIFF(fec_vencimiento,CURDATE()) <= '30' AND estado = '1'");

        return count($tecnomecanica->fetchall());
    }

    public function getNumLicenciaPorVencer()
    {
        $licencias = $this->_db->query("SELECT * FROM licencia
                                        WHERE DATEDIFF(fec_vencimiento,CURDATE()) <= '30' AND estado = '1'");

        return count($licencias->fetchall());
    }

    public function getNumPlanillas()
    {
        $planillas = $this->_db->query("SELECT * FROM planillas");

        return count($planillas->fetchall());
    }

    public function getNumPasajeros()
    {
        $pasajeros = $this->_db->query("SELECT * FROM pasajeros");

        return count($pasajeros->fetchall());
    }

    public function getNumPlanillasHoy()
    {
        $planillas = $this->_db->query("SELECT * FROM planillas WHERE fec_inicial = CURRENT_DATE");

        return count($planillas->fetchall());
    }

    public function getNumAutomotores()
    {
        $automotores = $this->_db->query("SELECT * FROM automotor");
        return count($automotores->fetchall());
    }

    public function getNumSoat()
    {
        $soat = $this->_db->query("SELECT * FROM soat");
        return count($soat->fetchall());
    }

    public function getNumTarjetasOperacion()
    {
        $t_operacion = $this->_db->query("SELECT * FROM tarjeta_operacion");
        return count($t_operacion->fetchall());
    }

    public function getNumTecnomecanica()
    {
        $tecnomecanica = $this->_db->query("SELECT * FROM tecnomecanica");

        return count($tecnomecanica->fetchall());
    }

    public function getNumRecorridos()
    {
        $recorridos = $this->_db->query("SELECT * FROM recorridos");
        return count($recorridos->fetchall());
    }

    public function getNumAutomotoresDisponibles()
    {
        $automotores = $this->_db->query("SELECT
                                            COUNT(id_automotor)
                                            FROM
                                            planillas
                                            WHERE
                                            fec_inicial = CURDATE() AND
                                            fec_final = CURDATE()
                                            GROUP BY
                                            id_automotor");
        return count($automotores->fetchall());
    }
    
}

?>