<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
//use Zend\Db\Adapter\Driver\StatementInterface;
//use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\sql\sql;
use Zend\Db\sql\Select;

class Alam2{
    private $adapter;
    
    public function __construct($config){
        $this->adapter = new Adapter($config);
    }

    public function read(){
		//Alternatif1
        $tableIan = new Sql($this->adapter);
		
		$rowset = new Select();
		$rowset = $tableIan->SELECT()
			->FROM('a')
			->WHERE('a.ad = 1');
				
		$statement = $tableIan->prepareStatementForSqlObject($rowset);
		$result = $statement->execute();
		
		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);

			$data = $resultSet->toArray();
			return $data;
		}
	}
	
	public function read2(){
		$stmt = $this->adapter->createStatement
		('SELECT a.ad, a.se, a.pt, b.id AS bid, c.Info AS CInf
			FROM a 
				JOIN b ON a.ad = b.ad
					LEFT JOIN c ON b.id = c.id
		');

		//$stmt->prepare($parameters); contoh di bookmark Zend konek untuk memasukkan parameter yg ingin dilewatkan ke statement
		$result = $stmt->execute();

		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);

			//foreach ($resultSet as $row) {
			//echo $row->my_column . PHP_EOL;
			//}
			
			$data = $resultSet->toArray();
			return $data;
		}		
	}
}

?>
