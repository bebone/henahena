<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use JMS\SecurityExtraBundle\Annotation\Secure;
use AppBundle\Entity\Lieu;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\PageType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {

        return $this->render('AppBundle::index.html.twig');
    }
    /**
     * @Route("/logements", name="logements")
     */
     public function logementsAction()
    {
        return $this->render('AppBundle::logement.html.twig');
    }
    
     /**
     * @Route("/bons-plans", name="bonsplans")
     */
     public function bonplansAction()
    {
        return $this->render('AppBundle::bonsplans.html.twig');
    }

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/page/create", name="page_create")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page = new Page();
        $user = $this->getUser(); //On récupère l'utilisateur
        $form = $this->createForm(new PageType(), $page);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $page->setUser($user);
            $em->persist($page);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "La page a bien été ajoutée");
            return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('AppBundle:page:pageCreate.html.twig', array(
            'entity' => $page,
            'form' => $form->createView()
        ));

    }


    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/bons-plans/edit", name="editPage")
     */
    public function editAction()
    {
        return $this->render('AppBundle::editPage.html.twig');
    }



    
}


   
