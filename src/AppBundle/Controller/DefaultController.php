<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class DefaultController extends Controller // Controller par défaut - pages pré définis
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {

        return $this->render('AppBundle::index.html.twig');
    }
    /**
     * @Route("/logements", name="logements")
     */
     public function logementsAction()
    {

        return $this->render('AppBundle::logement.html.twig');
    }
    
     /**
     * @Route("/bons-plans", name="bonsplans")
     */
     public function bonplansAction()
    {


        return $this->render('AppBundle::bonsplans.html.twig');
    }





}


   
