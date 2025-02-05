<?php
namespace App\Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use App\Controller\ProductController;
use App\Controller\UserController;

trait TwigControllertrait{

    protected $twig=null;
    public function getTwig()
    {
        $loader = new FilesystemLoader(realpath($_SERVER["DOCUMENT_ROOT"] . '/../') .'\src\templates');
        $twig = new \Twig\Environment($loader, [
            //'cache' => realpath($_SERVER["DOCUMENT_ROOT"].'/src/cache'),    
        ]);
        $this->twig = $twig;
    }
    public function Twig()
    {
        if($this->twig==null) $this->getTwig();
        return $this->twig;
    }
}

?>