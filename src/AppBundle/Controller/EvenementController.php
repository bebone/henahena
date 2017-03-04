<?php
/**
 * Created by PhpStorm.
 * User: anais
 * Date: 09/02/17
 * Time: 12:01
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Evenement;
use UserBundle\Entity\User;
use AppBundle\Form\Type\EvenementType;


class EvenementController extends Controller // Gestion des événements
{



    /**
     * @Secure(roles="ROLE_USER")
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
            $evenement->setDateModif(new \DateTime());
            $em->persist($evenement);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "L'évenement a bien été ajouté");
            return $this->redirect($request->headers->get('referer'));
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/evenement/{id}", name="evenement_view", requirements={"id": "\d+"})
     */
    public function viewEvenementAction($id) //Affichage d'un évenement
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AppBundle:Evenement')->find($id);
        $isParticipant = $evenement->isParticipant($this->getUser());

        return $this->render('AppBundle:evenement:evenementView.html.twig', array('evenement'=>$evenement,'isParticipant'=>$isParticipant));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/evenement/{id}/edit", name="evenement_edit", requirements={"id": "\d+"})
     *
     */
    public function editEvenementAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Evenement')->find(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException("Impossible");
        }
        if ($this->getUser() == $entity->getUser()) {  //On vérifie bien qu'il s'agit de l'auteur

            $editForm = $this->createForm(new EvenementType(), $entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $entity->setDateModif(new \DateTime()); //nouvelle date
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', "L'événement a bien été modifié.");
                return $this->redirect($request->headers->get('referer'));
            }
            return $this->render('AppBundle:evenement:evenementEdit.html.twig', array(
                'entity' => $entity,
                'form' => $editForm->createView(),
            ));
        } else {
            //On lui indique l'erreur Forbidden 403
            return $this->render('UserBundle:Default:privileges.html.twig', array('error' => 403));

        }
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/evenements-manage", name="evenement_manage")
     */
    public function evenementManageAction(Request $request) //Création d'un événement
    {
        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository('AppBundle:Evenement')->findAll();
        $newevenement = new Evenement();


        $form = $this->createForm(new EvenementType(), $newevenement);

        return $this->render('UserBundle:Admin:evenementAdmin.html.twig', array('evenements' => $evenements,'form'=>$form->createView()));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/evenement/{id}/delete", name="evenement_delete")
     *
     */
    public function deleteEvenementAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AppBundle:Evenement')->find(array('id' => $id));

        if (!$evenement) {
            throw $this->createNotFoundException("Impossible");
        }

            $em->remove($evenement);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "L'événement a bien été supprimé");
            return $this->redirect($request->headers->get('referer'));


    }


}