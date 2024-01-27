<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

class Bioskop
{
    private $adapter;
    
    public function __construct($config){
        $this->adapter = new Adapter($config);
    }

    public function read(){
        $select = new Sql($this->adapter);
		
		$rowset = new Select();
		$rowset = $select->SELECT()
			->FROM('film');
				
		$statement = $select->prepareStatementForSqlObject($rowset);
		$result = $statement->execute();
		
		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);

			$data = $resultSet->toArray();
			return $data;
		}
	}

    public function getOrder() {
        $sql = new Sql($this->adapter);
    
        $select = $sql->select()
            ->FROM(['o' => 'order'])
            ->JOIN(['f' => 'film'], 'o.id_film = f.id_film', ['nama_film', 'jam_tayang', 'harga_tiket'])
            ->WHERE('o.id_status_pembayaran = 1')
            ->ORDER('o.created_at DESC');
    
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
    
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);
    
            $data = $resultSet->toArray();
            foreach ($data as $key => $value) {
                $value['nomor_duduk'] = explode(',', $value['nomor_duduk']);
                $value['total_harga'] = count($value['nomor_duduk']) * $value['harga_tiket'];
                $data[$key] = $value;
                return $data;
            }
            return $data;
        }
    }
	
    public function getData(){
        $data = $_SERVER;
        return $data;
      }
}

?>
