<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;

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
            ->JOIN(['f' => 'film'], 'o.id_film = f.id_film', ['nama_film', 'jam_tayang', 'harga_tiket', 'film_image'])
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

    public function updatePeyment($orderId){
        $sql = new Sql($this->adapter);

        $update = new Update('order');
        $update->set(['id_status_pembayaran' => 2]);
        $update->where(['id_order' => $orderId['id']]);

        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        return $result->getAffectedRows();
    }
	
    public function getData(){
        $data = $_SERVER;
        return $data;
    }

    public function insertPembayaran($input)
    {
        $sql = new Sql($this->adapter);

        $insert = new Insert('order');
        $insert->values([
            'id_film' => $input['id_film'],
            'id_status_pembayaran' => $input['id_status_pembayaran'],
            'nomor_duduk' => $input['nomor_duduk'],
        ]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        // return order
        $select = $sql->select()
            ->from(['o' => 'order'])
            ->join(['f' => 'film'], 'o.id_film = f.id_film', ['nama_film'])
            ->where(['o.id_status_pembayaran' => 1])
            ->order('o.created_at DESC') 
            ->limit(2);

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            $data = $resultSet->toArray();
            if (count($data) !== 1) {
                $checkLastId = $data[count($data) - 1];
                if($checkLastId['id_status_pembayaran'] == 1){
                    $returnValue = [
                        'id_order' => $checkLastId['id_order'],
                        'nama_film' => $checkLastId['nama_film'],
                        'id_status_pembayaran' =>  $checkLastId['id_status_pembayaran']
                    ];
                    
                    //Delete inserted row
                    $secondToLastRow = $data[count($data) - 2];
                    $delete = new Delete('order');
                    $delete->where(['id_order' => $secondToLastRow['id_order']]);

                    $deleteID = $sql->prepareStatementForSqlObject($delete);
                    $deleteID->execute();
                    return $returnValue;
                } else {
                    $secondToLastRow = $data[count($data) - 2];
                    $returnValue = [
                        'id_order' => $secondToLastRow['id_order'],
                        'nama_film' => $secondToLastRow['nama_film'],
                    ];
                    return $returnValue;
                } 
            } else {
                $returnValue = [
                    'id_order' => $data[0]['id_order'],
                    'nama_film' => $data[0]['nama_film'],
                ];
                return $returnValue;
            }
        }
    }
}

?>
