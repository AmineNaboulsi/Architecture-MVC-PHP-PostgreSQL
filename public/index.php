<?php
require realpath(__DIR__.'/../vendor/autoload.php');
use App\Routes\MainRoute;

$MainRoute = new MainRoute();
$MainRoute->disptach();

?>