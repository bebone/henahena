<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {

        return $this->render('AppBundle::index.html.twig');
    }
    /**
     * @Route("/logement")
     */
     public function logementAction()
    {
        return $this->render('AppBundle::logement.html.twig');
    }
    
     /**
     * @Route("/bonsplans")
     */
     public function bonplansAction()
    {
        return $this->render('AppBundle::bonsplans.html.twig');
    }

    
    
    
}


   
