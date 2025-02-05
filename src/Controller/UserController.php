<?php
namespace App\Controller;

use App\Controller\TwigController;
use JWT;
use App\Config\DbConnection;
use App\Routes\Route;
//
// $MainRoute->post(uri:'/login' ,controller:UserController::class, method:"Login" ,parametres:['email' , 'password']);
// $MainRoute->post(uri:'/register' ,controller:UserController::class, method:"Register" ,parametres:['name', 'email' , 'password']);

// $MainRoute->post(uri:'/product/add' ,controller:ProductController::class, method:"Save",role:'admin' ,middleware:AuthMiddleware::class);
// $MainRoute->put(uri:'/product/update' ,controller:ProductController::class, method:"UpdateProduct",role:'admin',middleware:AuthMiddleware::class);
// $MainRoute->delete(uri:'/product/delete' ,controller:ProductController::class, method:"DelProduct" ,role:'admin',middleware:AuthMiddleware::class);

class UserController extends TwigController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Register() {
        
        echo $this->twig->render('client/index.twig', []);
    }
    #[Route(uri:'/login' , method: "POST" , )]
    public function Login($request) {
        
        $email = $request['body']['email'] ?? '';
        $password = $request['body']['password'] ?? '';

        $db = DbConnection::connect();
        $sqlDataReader = $db->prepare("SELECT * FROM Users WHERE email = :email");
        $sqlDataReader->execute(
                [
                ":email"=> $email
                ]
        );
        $user = $sqlDataReader->fetch(\PDO::FETCH_ASSOC);
      
        if(!$user || $user['password'] != $password ){
            http_response_code(401);
            header("Location:/signin");  
            $_SESSION['status'] = true;
            $_SESSION['message'] = "Invalid email or password.";
            return;
        }
        // if (!$user || !password_verify($password, $user['password'])) {
        //     http_response_code(401);
        //     echo json_encode(["error" => "Invalid email or password."]);
        //     return;
        // }
        $_SESSION['auth'] = true;
        $_SESSION['role'] = $user['role'];
        if($user['role'] == 'admin'){
            header("Location:/dashborad"); 
        }else{
            header("Location:/"); 
        }
    }
}
?>