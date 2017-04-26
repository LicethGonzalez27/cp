<?php

class tecnomecanicaController extends Controller
{
    private $_tecno;
    
    public function __construct() 
    {
        parent::__construct();
        $this->_tecno = $this->loadModel('tecnomecanica');
        $this->_view->setJs(array('tecnomecanica')); 
    }
    
    public function index()
    {
        $this->_view->titulo = 'Certificados de Revisión Tecnico Mecánica y de Emisiones Contaminantes ';
        $this->_view->descripcion = 'Permite agregar, consultar y actualizar los certificados';
        $this->_view->icono = 'hi hi-wrench';

        $this->_view->tecnomecanicas = $this->_tecno->getTecnomecanicas();
        $this->_view->automotores = $this->_tecno->getAutomotores();
        $this->_view->renderizar('index', 'tecnomecanica');
    }
    
    public function roles()
    {
        $this->_view->titulo = 'Administracion de roles';
        $this->_view->roles = $this->_tecno->getRoles();
        $this->_view->renderizar('roles', 'acl');
    }

    public function getTecnomecanica()
    {
        echo json_encode($this->_tecno->getTecnomecanica());
    }


    public function crear_tecnomecanica()
    {

        $tecnomecanicas = $this->_tecno->getTecnomecanicasActivasPorAutomotor($this->getPostParam('id_automotor'));
        $mayor = 0;

        if (!$tecnomecanicas) {
           if($this->getPostParam('consecutivo')){
                $this->_tecno->setTecnomecanica(
                    $this->getPostParam('consecutivo'),
                    $this->getPostParam('fec_expedicion'),
                    $this->getPostParam('fec_vencimiento'),
                    $this->getPostParam('id_automotor'),
                    '1'
                    );
    
            }
        }else{
            for ($i=0; $i < count($tecnomecanicas) ; $i++) { 

                $diferencia = date_diff(date_create($this->getPostParam('fec_vencimiento')), date_create($this->tarjeta[$i]['fec_vencimiento']))->format('%R%a');
                if ($diferencia < 0) {

                    $this->_tecno->updateEstadoTecnomecanica($tecnomecanicas[$i]['id'], '0');
                    $mayor = 1;

                }else{

                    if($this->getPostParam('consecutivo')){
                        $this->_tecno->setTecnomecanica(
                            $this->getPostParam('consecutivo'),
                            $this->getPostParam('fec_expedicion'),
                            $this->getPostParam('fec_vencimiento'),
                            $this->getPostParam('id_automotor'),
                            '0'
                            );
            
                    }
                    $mayor = 0;
                    break;
                }
            }

            if ($mayor == 1) {
                if($this->getPostParam('consecutivo')){
                    $this->_tecno->setTecnomecanica(
                        $this->getPostParam('consecutivo'),
                        $this->getPostParam('fec_expedicion'),
                        $this->getPostParam('fec_vencimiento'),
                        $this->getPostParam('id_automotor'),
                        '1'
                        );
        
                }
            }

        }

        
    }

    
}

?>