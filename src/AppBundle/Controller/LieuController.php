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
use UserBundle\Entity\Lieu;
use AppBundle\Form\Type\LieuType;


class LieuController extends Controller // Gestion des événements
{
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/lieux-manage", name="lieu_manage")
     */
    public function lieuManageAction(Request $request) //Création d'un événement
    {
        $em = $this->getDoctrine()->getManager();
        $lieux = $em->getRepository('AppBundle:Lieu')->findAll();
        return $this->render('UserBundle:Admin:lieuAdmin.html.twig', array('lieux' => $lieux));
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/lieux/{id}/edit", name="lieu_edit")
     */
    public function lieuEditAction(Request $request, $id) //Création d'un événement
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Lieu')->find(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException("Impossible");
        }

            $editForm = $this->createForm(new LieuType(), $entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', "Le lieu a bien été modifié.");
                return $this->redirect($this->generateUrl('evenement', array('id' => $id)));
            }
            return $this->render('UserBundle:Admin:lieuEdit.html.twig', array(
                'entity' => $entity,
                'form' => $editForm->createView(),
            ));


    }



        /**
         * @Secure(roles="ROLE_ADMIN")
         * @Route("/lieux-manage", name="lieu_delete")
         */
        public function lieuDeleteAction(Request $request) //Création d'un événement
        {
        }

}


