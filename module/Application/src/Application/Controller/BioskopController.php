<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Bioskop; // Assuming you have a Film model

class BioskopController extends AbstractActionController
{
    private $config;
    private $db;

    public function indexAction()
    { 
        return new ViewModel();
    }

    public function listFilmAction()
    {
        
        $this->config = $this->getServiceLocator()->get('Config');
        $this->db = $this->config['db'];
    
        $bioskop = new \Application\Model\Bioskop($this->db);
        $data = $bioskop->read();
        $jsonResponse = [
            'code' => 0,
            'info' => 'OK',
            'data' => $data,
        ];

        // Encode the array to JSON using json_encode
        $jsonString = json_encode($jsonResponse);

        // Create a response object and set content and status code
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent($jsonString);

        return $response;
    }

    public function orderAction()
    {
        $this->config = $this->getServiceLocator()->get('Config');
        $this->db = $this->config['db'];
    
        $bioskop = new \Application\Model\Bioskop($this->db);
        $postData = $this->getRequest()->getPost();
        // $data = $bioskop->insertPembayaran();
        $jsonResponse = [
            'code' => 0,
            'info' => 'OK',
            'data' => $postData,
        ];

        // Encode the array to JSON using json_encode
        $jsonString = json_encode($jsonResponse);

        // Create a response object and set content and status code
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent($jsonString);

        return $response;

    }

    public function paymentAction()
    {
        return new ViewModel();
    }

    public function getListOrderAction()
    {
        $this->config = $this->getServiceLocator()->get('Config');
        $this->db = $this->config['db'];
    
        $bioskop = new \Application\Model\Bioskop($this->db);
        $data = $bioskop->getOrder();

        $jsonResponse = [
            'code' => 0,
            'info' => 'OK',
            'data' => $data,
        ];

        // Encode the array to JSON using json_encode
        $jsonString = json_encode($jsonResponse);

        // Create a response object and set content and status code
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent($jsonString);

        return $response;
    }

   
}

?>