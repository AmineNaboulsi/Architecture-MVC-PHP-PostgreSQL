<link rel="stylesheet" href="Css/output.css">
<link rel="stylesheet" href="Css/input.css">
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
<?php


require realpath(__DIR__.'/../vendor/autoload.php');
use App\Routes\MainRoute;

use App\Core\LogWriter;
LogWriter::info("Display Products");
session_start();

$MainRoute = new MainRoute();
$MainRoute->registerRoutes();
$MainRoute->disptach();



?>