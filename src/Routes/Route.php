<?php
namespace App\Routes;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Route
{
    public $uri;
    public $controller;
    public $method;
    public $parametres;
    public $role;
    public $middleware;

    public function __construct(
        string $uri,string $method,string $role = null,
        array  $parametres = [] ,?string  $middleware = null)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->role = $role;
        $this->parametres = $parametres;
        $this->middleware = $middleware;
    }

}

?>