<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    /**
     * @Route("/accueil")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('accueil.html.twig', array(
            'number' => $number,
        ));
    }
}