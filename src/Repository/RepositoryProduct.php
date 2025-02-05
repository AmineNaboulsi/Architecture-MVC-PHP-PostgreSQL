<?php

namespace App\Repository;
use App\Config\DbConnection;
use App\Core\LogWriter;

class RepositoryProduct{

    public function getProducts() {
        $con = DbConnection::connect();
        $sqlDataReaer = $con->prepare('SELECT * FROM Products');
        if($sqlDataReaer->execute()){
            $Data = $sqlDataReaer->fetchAll(\PDO::FETCH_ASSOC);
            LogWriter::info("Display Products");
            return $Data;
        }else{
            LogWriter::error("Error To display products");
            return [];
        }
    }

}

?>