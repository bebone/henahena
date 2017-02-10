<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
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
}
