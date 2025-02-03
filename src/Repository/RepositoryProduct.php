<?php

namespace App\Repository;
use App\Config\DbConnection;

class RepositoryProduct{

    public function getProducts() {
        $con = DbConnection::connect();
        return ['products' => [
            [
                "id"=>64,
                "name"=>"test1",
                "price"=>644,
            ],
            [
                "id"=>7,
                "name"=>"test2",
                "price"=>6542,
            ]
        ]
            ];
    }

}

?>