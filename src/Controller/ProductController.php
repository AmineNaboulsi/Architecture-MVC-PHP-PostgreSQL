<?php
namespace App\Controller;
use App\Repository\RepositoryProduct;

class ProductController
{
    public function getProduct(){
        $RepositoryProduct =new RepositoryProduct();
        return $RepositoryProduct->getProducts();
    }
}
?>