<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Dotenv\Dotenv;
class AuthMiddleware extends Middleware {

    private $role;
    public function __construct($role)
    {
        $this->role = $role;
    }
    public function handle($request, $next) {
        try {
            if(!isset($_SESSION['auth']) ||  $_SESSION['auth']==false){
                header('location:signin');
                return;
            }
            if($_SESSION['role'] == $this->role){
                return $next($request);
            }
            else{
                $_SESSION['message'] = 'Unauthorized access. Please log in.';
                header('location: /authorization');
            }
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid or expired token.", "details" => $e->getMessage()]);
            exit;
        }
    }
}
