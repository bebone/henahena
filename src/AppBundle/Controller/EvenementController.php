<?php
/**
 * Created by PhpStorm.
 * User: anais
 * Date: 09/02/17
 * Time: 12:01
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Evenement;
use UserBundle\Entity\User;
use AppBundle\Form\Type\EvenementType;


class EvenementController extends Controller
{
    /**
     * @Route("/evenement/{id}", name="evenement_view", requirements={"id": "\d+"})
     */
    public function evenementAction($id) //Affichage d'un évenement
    {
        $em = $this->getDoctrine()->getEntityManager();
        $evenement = $em->getRepository('AppBundle:Evenement')->find($id);

        return $this->render('AppBundle:evenement:evenement.html.twig', array('evenement'=>$evenement));
    }


    /**
     * @Route("/evenement/create", name="evenement_create")
     */
    public function evenementCreateAction(Request $request) //Création d'un événement
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = new Evenement();
        $user = $this->getUser(); //On récupère l'utilisateur

        $form = $this->createForm(new EvenementType(), $evenement);

        $form->handleRequest($request);
        if ($form->isValid()) {

            $evenement->setUser($user);
            $em->persist($evenement);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "L'évenement a bien été ajouté");
            return $this->redirect($this->generateUrl('evenement_view', array('id' => $evenement->getId())));;
        }

        return $this->render('AppBundle:evenement:evenementCreate.html.twig', array(
            'entity' => $evenement,
            'form' => $form->createView()
        ));
    }



}