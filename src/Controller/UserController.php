<?php
namespace App\Controller;

use App\Controller\TwigController;
use JWT;
use App\Config\DbConnection;
use App\Config\JwtHandler;
class UserController extends TwigController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Register() {
        
        echo $this->twig->render('client/index.twig', []);
    }

    public function Login($request) {
        session_start();
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

        $payload = [
            "id" => $user['id'],
            "email" => $user['email'],
            "exp" => time() + (60 * 60) 
        ];

        $jwt = JwtHandler::generateToken($payload);
        header("Location:/"); 
    }
}
?>