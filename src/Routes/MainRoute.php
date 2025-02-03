<?php
namespace App\Routes;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use App\Controller\ProductController;
use App\Controller\UserController;
class MainRoute{

    private string $method ;
    private string $uri ;
    private array $routes ;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD']; 
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->routes = [
            'GET'=>[
                '/products' => [ProductController::class , 'getProduct'],
            ],
            'POST'=>[
                '/signin' => [UserController::class , ''],
                '/signup' => [UserController::class , ''],
            ],
        ]  ;
    }
    public function disptach(){
        $loader = new FilesystemLoader(realpath($_SERVER["DOCUMENT_ROOT"] . '/../') .'\src\templates');
        $twig = new \Twig\Environment($loader, [
            // 'cache' => realpath(__DIR__.'/../src/cache'),
        ]);
        $twig->addFunction(new \Twig\TwigFunction('asset', function ($path) {
            return sprintf( '/public/%s', ltrim($path, '/'));
        }));
        $endpoint = "";
        if($_SERVER["REQUEST_URI"] =="/"){
            $endpoint =  "/index.twig";
        }else{
            $endpoint =  $_SERVER["REQUEST_URI"] . '.twig';
        }

        if(file_exists(realpath($_SERVER["DOCUMENT_ROOT"] . '/../') .'\src\templates' . $endpoint)){
            $data= [];
            if(isset($this->routes[$this->method][$this->uri])){
                $route = $this->routes[$this->method][$this->uri];
                $class = $route[0];
                $method =$route[1];
                $controller = new $class;
                $data = $controller->$method();
            }
            echo $twig->render($endpoint,$data);
        }else{
            echo $twig->render('pagenotfound.twig', ['message' => "Page Not Found 404"]);
        }
    }
}

?>