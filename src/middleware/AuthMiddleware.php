<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Dotenv\Dotenv;
class AuthMiddleware extends Middleware {

    public function handle($request, $next) {
        $headers = getallheaders();
        
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(["error" => "Access denied. No token provided."]);
            exit;
        }

        try {

            $request['user'] = (array) $decoded;
            
            return $next($request);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid or expired token.", "details" => $e->getMessage()]);
            exit;
        }
    }
}
