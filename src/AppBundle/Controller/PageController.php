<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Lieu;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\PageType;



class PageController extends Controller // Gestion des pages
{
    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/page/create", name="page_create")
     */
    public function createPageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page = new Page();
        $user = $this->getUser(); //On récupère l'utilisateur
        $form = $this->createForm(new PageType(), $page);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $titre = $page->getTitre();
            // replace non letter or digits by -
            $titre = preg_replace('~[^\pL\d]+~u', '-', $titre);
            $titre = iconv('utf-8', 'us-ascii//TRANSLIT', $titre);
            $titre = preg_replace('~[^-\w]+~', '', $titre);
            $titre = trim($titre, '-');
            $titre = preg_replace('~-+~', '-', $titre);
            $titre = strtolower($titre);

            $page->setSlug($titre);
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
     *
     * @Route("/{slug}", name="page" , requirements= {"slug": "[a-zA-Z]+"})
     */
    public function viewPageAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Page')->findOneBy(array('slug'=>$slug));

        return $this->render('AppBundle:page:page.html.twig', array('page'=>$entity));
    }


    /**
     * @Secure(roles="ROLE_ADMIN")
     * @Route("/{slug}/edit", name="page_edit", requirements= {"slug": "[a-zA-Z]+"})
     * @Method({"GET", "POST"})
     */
    public function editPageAction(Request $request, $slug)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Page')->findOneBy(array('slug'=>$slug));

        if (!$entity) {
           throw $this->createNotFoundException("Impossible");

        }

        $editForm = $this->createForm(new PageType(), $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "La page a bien été modifiée.");
            return $this->redirect($this->generateUrl('page', array('slug' => $slug)));
        }

        return $this->render('AppBundle:page:pageEdit.html.twig', array(
            'entity' => $entity,
            'form' => $editForm->createView(),
        ));

    }

}