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
use AppBundle\Entity\Participe;
use UserBundle\Entity\User;
use UserBundle\Entity\Evenement;



class ParticipeController extends Controller // Gestion des événements
{


    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/participe/{id}", name="participe_add")
     */
    public function participeCreateAction(Request $request, $id) //Création d'un événement
    {
            $em = $this->getDoctrine()->getManager();
            $evenement = $em->getRepository('AppBundle:Evenement')->find($id);
            $participe = new Participe();
            $participe->setDateAjout(new \DateTime());
            $participe->setEvenement($evenement);
            $participe->setUser($this->getUser());
            $em->persist($participe);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "Participation ajouté !");
            return $this->redirect($request->headers->get('referer'));


        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/participe/delete/{evenementId}/{participantId}", name="participe_delete")
     */
    public function participeDeleteAction(Request $request, $evenementId, $participantId) //Création d'un événement
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('AppBundle:Evenement')->find($evenementId);
        $participant=$em->getRepository('AppBundle:Participe')->find($participantId);
        $evenement->removeParticipant($participant);
        $em->remove($participant);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', "Participation supprimé !");
        return $this->redirect($request->headers->get('referer'));


    }
}