<link rel="stylesheet" href="Css/output.css">
<link rel="stylesheet" href="Css/input.css">
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
<?php


require realpath(__DIR__.'/../vendor/autoload.php');
use App\Routes\MainRoute;
use App\Controller\ProductController;
use App\Controller\UserController;
use App\Controller\TemplateController;
use App\Core\LogWriter;
use App\Middleware\AuthMiddleware;
LogWriter::info("Display Products");

$MainRoute = new MainRoute();

//
$MainRoute->get(uri:'/' ,controller:TemplateController::class, method:"Home",role:'client' ,middleware:[AuthMiddleware::class]);
$MainRoute->get(uri:'/dahsborad' ,controller:TemplateController::class, method:"Dashborad",role:'client' ,middleware:[AuthMiddleware::class]);
$MainRoute->get(uri:'/signin' ,controller:TemplateController::class, method:"Signin");
$MainRoute->get(uri:'/signup' ,controller:TemplateController::class,method: "Signup");
$MainRoute->get('/products' ,controller:TemplateController::class, method:"Products" ,role:'client' ,middleware:[AuthMiddleware::class]);

//
$MainRoute->post(uri:'/login' ,controller:UserController::class, method:"Login" ,parametres:['email' , 'password']);
$MainRoute->post(uri:'/register' ,controller:UserController::class, method:"Register" ,parametres:['name', 'email' , 'password']);

$MainRoute->post(uri:'/product/add' ,controller:ProductController::class, method:"Save",role:'admin' ,middleware:[AuthMiddleware::class]);
$MainRoute->put(uri:'/product/update' ,controller:ProductController::class, method:"UpdateProduct",role:'admin',middleware:[AuthMiddleware::class]);
$MainRoute->delete(uri:'/product/delete' ,controller:ProductController::class, method:"DelProduct" ,role:'admin',middleware:[AuthMiddleware::class]);

$MainRoute->disptach();

?>