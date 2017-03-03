<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Bonplan;
use AppBundle\Form\Type\BonplanType;

class DefaultController extends Controller
{



    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profil")
     */
    public function profilAction() // Mon profil
    {
        //TODO ici récuperer TOUTES les données, limiter les résultats
        $user = $this->getUser();
        $bonplan = new Bonplan();

        $form = $this->createForm(new BonplanType(), $bonplan);


        return $this->render('UserBundle:Default:profil.html.twig',array('user'=>$user, 'form'=>$form->createView()));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profil/{id}", name="user_profilof")
     */
    public function profilOfAction($id) //Le profil d'un user
    {

        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('UserBundle:User')->find($id);
        if($user==null) {
            return $this->render('UserBundle:Default:privileges.html.twig',array('error'=>500)); //si la page n'existe pas
        }
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

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/profil/{id}/edit", name="user_edit")
     *
     */
    public function editUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find(array('id' => $id));

        if (!$user) {
            throw $this->createNotFoundException("Impossible");
        }
        if ($this->getUser() == $user) {  //On vérifie bien qu'il s'agit de l'auteur

            $editForm = $this->createForm(\UserBundle\Form\Type\RegistrationFormType::class, $user);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', "Le profil a bien été modifié.");
                return $this->redirect($request->headers->get('referer'));
            }

        }
    }

}
