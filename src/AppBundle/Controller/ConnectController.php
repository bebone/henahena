<?php
namespace AppBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use AppBundle\Entity\Bonplan;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\BonplanType;
use Symfony\Component\Validator\Constraints\DateTime;



class ConnectController extends Controller //Utilisateur Connecté sur la plateforme
{
    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/connect", name="connect_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Bonplan')->findAll();
        return $this->render('AppBundle:connect:index.html.twig', array());
    }
}