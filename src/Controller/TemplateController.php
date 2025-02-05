<?php

namespace App\Controller;
use App\Repository\RepositoryProduct;
use App\Routes\Route;
class TemplateController extends TwigController{

    use TwigControllertrait;

    public function __construct()
    {
        parent::__construct();

    }
    
    #[Route(uri:'/authorization', method: 'GET')]
    public function authorization() {
        echo $this->Twig()->render('403/page403.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
        unset($_SESSION['message']);
    }

    #[Route(uri:'/signin', method: 'GET')]
    public function Signin() {
        echo $this->Twig()->render('client/signin.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
        session_destroy();
    }

    #[Route(uri:'/signup', method: 'GET')]
    public function Signup(){
        echo $this->Twig()->render('client/signup.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
    }

    #[Route(uri:'/', method: 'GET', role: 'client', middleware: 'AuthMiddleware::class')]
    public function Home(){
        echo $this->Twig()->render('client/index.twig',[
            "SESSION" => $_SESSION 
        ]);
    }


    #[Route(uri:'/products', method: 'GET', role: 'client', middleware: 'AuthMiddleware::class')]
    public function Products(){
        $RepositoryProduct = new RepositoryProduct();
        $data =  $RepositoryProduct->getProducts();
        echo $this->twig->render('client/products.twig', [
            "SESSION" => $_SESSION ,
            "products" => $data
        ]
        
        );
    }


    #[Route(uri: '/dashboard', method: 'GET', role: 'admin', middleware: 'AuthMiddleware::class')]
    public function Dashboard() {
        echo $this->twig->render('admin/dashborad.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
    }
}

?>