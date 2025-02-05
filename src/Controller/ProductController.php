<?php
namespace App\Controller;
use App\Repository\RepositoryProduct;
use App\Controller\TwigController;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Core\LogWriter;

class ProductController 
{
    public function Find(){
        $RepositoryProduct =new RepositoryProduct();
        return $RepositoryProduct->getProducts();
    }

    public function Save() {
        return ['message' => 'Product added successfully'];
    }

    public function updateProduct() {
        return ['message' => 'Product updated successfully'];
    }

    public function DelProduct() {
        return ['message' => 'Product deleted successfully'];
    }
    
}
?>