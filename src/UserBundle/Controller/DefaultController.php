<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserBundle\Entity\User;

class DefaultController extends Controller
{



    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profil")
     */
    public function profilAction()
    {
        //TO DO ici récuperer TOUTES les données, limiter les résultats
        $user = $this->getUser();
        return $this->render('UserBundle:Default:profil.html.twig',array('user'=>$user));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profil/evenements/{page}")
     */
    public function userEvenementsAction($page) //AJAX liste des évenements créés par l'utilisateur
    {

        $user = $this->getUser();
        $nbParPage =2; //TODO (10 en dur)
        $em = $this->getDoctrine()->getManager();
        $evenements=$em->getRepository('AppBundle:Evenement')->getUserEvenements($user,$nbParPage);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($evenements) / $nbParPage),
            'nomRoute' => 'projets_ajax',
            'paramsRoute' => array()
        );

        return $this->render('AppBundle:User:userEvenements.html.twig', array('evenements'=>$evenements, 'pagination'=>$pagination));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profil/bons-plans/{page}")
     */
    public function userBonsplansAction($page) //AJAX liste des bons plans créés par l'utilisateur
    {

        $user = $this->getUser();
        $nbParPage =2; //TODO (10 en dur)
        $em = $this->getDoctrine()->getManager();
        $bonsplans=$em->getRepository('AppBundle:Bonplan')->getUserBonsplans($user,$page, $nbParPage);


        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($bonsplans) / $nbParPage),
            'nomRoute' => 'projets_ajax',
            'paramsRoute' => array()
        );

        return $this->render('UserBundle:Default:userBonsplans.html.twig', array('bonsplans'=>$bonsplans, 'pagination'=>$pagination));
    }





}
