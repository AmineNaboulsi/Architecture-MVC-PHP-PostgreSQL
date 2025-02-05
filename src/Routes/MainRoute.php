<?php
namespace App\Routes;

use App\Routes\Route;
use App\Controller\TwigController;
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
       //GET
       public function get($uri , $controller,$method,$role=null,$parametres=[],$middleware=null)
       { $this->routes['GET'][$uri] = new Route($uri , $controller,$method,$role,$parametres,$middleware);}
       
       //POST
       public function post($uri , $controller,$method,$role=null,$parametres=[],$middleware=null)
       { $this->routes['POST'][$uri] = new Route($uri , $controller,$method,$role,$parametres,$middleware);}
       
       //PUT
       public function put($uri , $controller,$method,$role=null,$parametres=[],$middleware=null)
       { $this->routes['PUT'][$uri] = new Route($uri , $controller,$method,$role,$parametres,$middleware);}
   
       //PATCH
       public function patch($uri , $controller,$method,$role=null,$parametres=[],$middleware=null)
       { $this->routes['PATCH'][$uri] = new Route($uri , $controller,$method,$role,$parametres,$middleware);}
   
       //DELETE
       public function delete($uri , $controller,$method,$role=null,$parametres=[],$middleware=null)
       { $this->routes['DELETE'][$uri] = new Route($uri , $controller,$method,$role,$parametres,$middleware);}

    public function disptach(){
        $Found = false;
        foreach ($this->routes[$this->method] as $route => $r) {
            if($route == $this->uri ){
                $class =  $r->controller;
                $method =  $r->method;
                $controller = new $class;
                if($r->middleware!=null){
                    $middleware = new $r->middleware();
                    $middleware->handle();
                }
                $request = [
                    'params' => $_GET,
                    'body' => json_decode(file_get_contents('php://input'), true) ?? $_POST
                ];
                return $controller->$method($request);
            }
        }
        if(!$Found) echo $this->twig->render('client/pagenotfound.twig', ['message' => "Page Not Found 404"]);
    }
}

?>