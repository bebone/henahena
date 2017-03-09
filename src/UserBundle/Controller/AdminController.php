<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use UserBundle\Entity\User;

class AdminController extends Controller
{


    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/admin")
     */
    public function profilAction()
    {
        //TO DO ici récuperer TOUTES les données, limiter les résultats
        $user = $this->getUser();
        return $this->render('UserBundle:Admin:admin.html.twig', array('user' => $user));
    }

}