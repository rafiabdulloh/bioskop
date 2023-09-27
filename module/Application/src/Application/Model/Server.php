<?php

namespace Application\Model;

class Server{ // Ini model
  public function getData(){
    $data = $_SERVER;
    return $data;
  }
}

?>
