<?php
namespace App\Routes;

use App\Routes\Route;
use App\Controller\TwigController;
use App\Controller\ProductController;
use App\Controller\UserController;
use App\Controller\TemplateController;
use App\Middleware\AuthMiddleware;

class MainRoute extends TwigController{

    private string $method ;
    private string $uri ;
    private array $routes ;

    public function __construct()
    {
        parent::__construct();
        $this->method = $_SERVER['REQUEST_METHOD']; 
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->routes = [
            'GET' => [] ,
            'POST' => [] ,
            'PUT' => [] ,
            'DELETE' => [] ,
            'PATCH' => [] ,
        ];
    }
    public function registerRoutes()
    {
        $controllerClassNames = [ProductController::class, UserController::class, TemplateController::class];
    
        foreach ($controllerClassNames as $controllerClass) {
            $reflectionClass = new \ReflectionClass($controllerClass);
    
            foreach ($reflectionClass->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class);
    
                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
    
                    $this->routes[$route->method][$route->uri] = [
                        'controller' => $controllerClass, 
                        'method' => $method->getName(),
                        'role' => $route->role,
                        'middleware' => $route->middleware,
                        'parametres' => $route->parametres,
                    ];
                }
            }
        }
    }
    
    public function disptach(){
        $Found = false;
        foreach ($this->routes[$this->method] as $route => $r) {
            if($route == $this->uri ){
                $class =  $r['controller'];
                $method =  $r['method'];
                $middleware =  new AuthMiddleware($r["role"]);
                $controller = new $class;
                $request = [
                    'params' => $_GET,
                    'body' => json_decode(file_get_contents('php://input'), true) ?? $_POST
                ];
                if($r['middleware'] !=null){
                    $middleware->handle($request ,function () use ($class, $method) {
                        $controller = new $class();
                        return $controller->$method();
                    });
                    $Found= true;
                    break;
                }
                $controller->$method($request);
                $Found = true;
                break;
            }
        }
        if(!$Found) echo $this->twig->render('client/pagenotfound.twig', ['message' => "Page Not Found 404"]);
    }
}

?>