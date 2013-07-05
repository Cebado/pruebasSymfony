<?php

namespace Acme\InicioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InicioController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeInicioBundle:Default:index.html.twig');
    }
    
    public function contactoAction()
    {
        return $this->render('AcmeInicioBundle:Default:contacto.html.twig');
    }
}


