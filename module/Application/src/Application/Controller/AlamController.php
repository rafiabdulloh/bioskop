<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlamController extends AbstractActionController{
    private $config;
    private $db;
  
    public function alamAction(){
        $this->config = $this->getServiceLocator()->get('Config'); //mengambil basis data autoconfig
        $this->db = $this->config['db'];
    
        $alam = new \Application\Model\Alam2($this->db);
        $data = $alam->read();
        
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($data));
        return $response;
    }
    
    public function showAlamAction(){ //Ini memunculkan alam melalui view
        return new ViewModel();
    }
    
}

?>