<?php
namespace AppBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use AppBundle\Entity\Bonplan;
use AppBundle\Entity\Evenement;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\BonplanType;
use Symfony\Component\Validator\Constraints\DateTime;


class BonplanController extends Controller // Gestion des bons plans
{
    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/bons-plans/create", name="bonsplans_create")
     */
    public function createBonplanAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bonplan = new Bonplan();
        $user = $this->getUser(); //On récupère l'utilisateur
        $form = $this->createForm(new BonplanType(), $bonplan);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $bonplan->setUser($user);
            $em->persist($bonplan);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "Le bon plan a bien été ajoutée");
            return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('AppBundle:bonsplans:bonplanCreate.html.twig', array(
            'entity' => $bonplan,
            'form' => $form->createView()
        ));
    }



    /**
     *
     * @Route("/bons-plans/{id}", name="bonplan_view")
     */
    public function viewBonplanAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bonplan')->find(array('id'=>$id));

        return $this->render('AppBundle:bonsplans:bonplanView.html.twig', array('bonplan'=>$entity));
    }


    /**
     *
     * @Route("/bons-plans_index/{page}", name="bonplan_ajax")
     */
    public function indexBonplanAction($page)
    {
        $nbParPage = 5; //TODO (10 en dur)
        $em = $this->getDoctrine()->getManager();
        $bonsplans = $em->getRepository('AppBundle:Bonplan')->getAllBonplan($page, $nbParPage);


        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($bonsplans) / $nbParPage),
            'nomRoute' => 'bonsplans_ajax',
            'paramsRoute' => array()
        );

        return $this->render('AppBundle:bonsplans:bonplanAjax.html.twig', array('bonsplans' => $bonsplans, 'pagination' => $pagination));

    }



    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/bons-plans/{id}/edit", name="bonplan_edit")
     *
     */
    public function editBonplanAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Bonplan')->find(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException("Impossible");
        }
        if ($this->getUser() == $entity->getUser()) {  //On vérifie bien qu'il s'agit de l'auteur

            $editForm = $this->createForm(new BonplanType(), $entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $entity->setDateModif(new \DateTime()); //nouvelle date
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', "Le bon plan a bien été modifié.");
                return $this->redirect($this->generateUrl('bonplan', array('id' => $id)));
            }
            return $this->render('AppBundle:bonsplans:bonplanEdit.html.twig', array(
                'entity' => $entity,
                'form' => $editForm->createView(),
            ));
        } else {
            //On lui indique l'erreur Forbidden 403
            return $this->render('UserBundle:Default:privileges.html.twig', array('error' => 403));

        }
    }


    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/bons-plans/{id}/delete", name="bonplan_delete")
     *
     */
    public function deleteBonplanAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $bonplan = $em->getRepository('AppBundle:Bonplan')->find(array('id' => $id));

        if (!$bonplan) {
            throw $this->createNotFoundException("Impossible");
        }
        if ($this->getUser() == $bonplan->getUser()) {  //On vérifie bien qu'il s'agit de l'auteur
            $em->remove($bonplan);
            $em->flush();
            return $this->redirect($request->headers->get('referer'));
            /*return $this->render('AppBundle:User:profil.html.twig', array(
                    'user' => $bonplan)
            );*/
        } else {
            //On lui indique l'erreur Forbidden 403
            return $this->render('UserBundle:Default:privileges.html.twig', array('error' => 403));

        }
    }


    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/home", name="bonplan_home_connect")
     *
     */
    public function homeConnectBonplanAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bonsplans = $em->getRepository('AppBundle:Bonplan')->findAll(); //TODO
        $evenements = $em->getRepository('AppBundle:Evenement')->findAll();

        return $this->render('AppBundle:bonsplans:bonsplans.html.twig', array('bonsplans'=>$bonsplans, 'evenements'=>$evenements));
    }



}