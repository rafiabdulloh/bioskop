<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\sql\sql;
use Zend\Db\sql\Select;

class Alam{
    private $adapter;
    
    public function __construct($config){
        $this->adapter = new Adapter($config);
    }

    public function read(){
		//Alternatif1
        $tableIan = new Sql($this->adapter);
		//$tableIan = new TableGateway('a', $this->adapter); // ALAM_A adalah tabel, a adalah tabel
		//$tableIan2 = new TableGateway('b', $this->adapter); // ALAM_A adalah tabel, b adalah tabel
		
        //$rowset = $tableIan->select(array('ad' => 1 )); //select() untuk all
        //$rowset = $tableIan->select(); //select() untuk all
        $rowset = $tableIan->SELECT();
							$rowset->FROM('a');
								
								
		//Contoh lain di selection subquery Zend from example
		//$rowset = $tableIan->select() ->from(array('a'), array("a.ad","a.se","a.pt","b.ad"))
					//->join(array('b'),"a.ad = b.ad",array())
					//->where("a.ad = (select max(ad) from b where id = a.ad)")
					//->order('b.ad asc');	
		
        //$resultSet = new ResultSet;
        //$resultSet->initialize($rowset);
        //$data = $resultSet->toArray();
        //return $data;
		
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
		//Alternatif2
		/*$sql= new sql($this->adapter);
		$select = $sql->select();
		$select->from('a');
		$select->where(array('ad' => 1));

		$statement = $sql->prepareStatementForSqlObject($select);
		$data = $statement->execute();
		return $data; */
		
		//=============================================================================
		//$sql= new sql ($this->adapter);
		//$stmt = $sql->createStatement('SELECT * FROM a'); // PHP 1 ini kayaknya
		//$stmt->prepare($parameters);
		//$result = $stmt->execute();

		//if ($result instanceof ResultInterface && $result->isQueryResult()) {
		/*	$resultSet = new ResultSet;
			$resultSet->initialize($result);
			$data = $resultSet->toArray();
			
		return $data;
		}	
		*/
		
		//=============================================================================
		// ITS WORK
		
		$stmt = $this->adapter->createStatement
		('SELECT a.ad,a.se,a.pt, b.id AS bid, c.info AS CInf		
			FROM a,b,c WHERE a.ad = b.ad AND b.id = c.id; 			
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
		//=============================================================================
	}
}

?>
