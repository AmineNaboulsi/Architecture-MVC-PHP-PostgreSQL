<?php
namespace App\Routes;

class Route
{
    public $uri;
    public $controller;
    public $method;
    public $parametres;
    public $role;
    public $middleware;

    public function __construct($uri,$controller,$method,$role,$parametres,$middleware)
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->method = $method;
        $this->role = $role;
        $this->parametres = $parametres;
        $this->middleware = $middleware;
    }

}

?>