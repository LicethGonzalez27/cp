<?php

class generalController extends Controller
{
    private $_general;
    
    public function __construct() 
    {
        parent::__construct();
        $this->_general = $this->loadModel('general');
        //$this->_view->setJs(array('acl')); 
    }

    public function index()
    {
        
    }

    public function getBadges()
    {
        echo json_encode($this->_general->getBadges());
    }

    public function getStats()
    {
        echo json_encode($this->_general->getStats());
    }

    

    
}
?>