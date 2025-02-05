<?php

namespace App\Controller;
use App\Repository\RepositoryProduct;

class TemplateController extends TwigController{

    public function __construct()
    {
        parent::__construct();

    }
    public function Signin() {
        session_start();
        echo $this->twig->render('client/signin.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
        session_destroy();
       }

    public function Signup(){
        echo $this->twig->render('client/signup.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
    }
    public function Home(){
        echo $this->twig->render('client/index.twig',[]);
    }
    public function Products(){
        $RepositoryProduct = new RepositoryProduct();
        $data =  $RepositoryProduct->getProducts();
        echo $this->twig->render('client/products.twig', $data);
    }

    public function Dashborad() {
        session_start();
        echo $this->twig->render('admin/dashborad.twig', 
        [
            "SESSION" => $_SESSION 
        ]);
        session_destroy();
    }
}

?>