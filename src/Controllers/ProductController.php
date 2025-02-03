<?php
namespace App\Controllers;

class ProductController
{
    public function getProduct(){
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