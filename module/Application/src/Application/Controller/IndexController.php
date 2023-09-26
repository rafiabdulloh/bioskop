<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction() // Ini punya default index
    {
        return new ViewModel();
    }
	
    public function varServerAction()//Ini Harusnya di Model, tapi ini langsung muncul SERVER di Controller
    // Hasil output function ini bisa juga digunakan di view supaya tampilan oke 
    {
	$response = $this -> getResponse();
	$response -> setStatusCode(200);
	$response -> setContent(json_encode($_SERVER));
	return $response;
    }	
	
    //public function testAction(){
	//echo "hallo"; die ;
    //}
	
    public function showServerAction(){ //Ini memunculkan server melalui view
        return new ViewModel();
    }
    
    public function getServerDataAction(){ //Ini melalui model SERVER
      $server = new \Application\Model\Server;
      $data = $server->getData();
      
      $response = $this->getResponse();
      
      $response->setStatusCode(200);
      $response->setContent(json_encode($data));
      return $response;
    }
    
    public function showServerDataAction(){ //Ini memunculkan server melalui view
        //return new ViewModel();
    }
}
