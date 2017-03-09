<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class DefaultController extends Controller // Controller par défaut - pages pré définis
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $bonsplans = $em->getRepository('AppBundle:Bonplan')->getDix();
        $formContact = $this->createForm(new ContactType());
        if($request->isMethod('post')){

            $formContact->handleRequest($request);
            if($formContact->isValid()){

                // Ici on récupére la class Contact qui a été préalablement Set avec les champs du formulaire
                $contact = $formContact->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject("[ HENA HENA ] ".$contact->getSujet())
                    ->setFrom($contact->getEmail())
                    // notre adresse mail
                    ->setTo('contact@anaisvidal.fr')
                    ->setContentType('text/html')
                    ->setBody(
                        $this->renderView('AppBundle:contact:email.html.twig', array(
                                'contact' => $contact
                            )
                        )
                    );
                // nous appelons le service swiftmailer et on envoi :)
                $this->get('mailer')->send($message);

                // on retourne une message flash pour l'utilisateur pour le prévenir que son mail est bien parti
                $this->get('session')->getFlashBag()->add('info', 'Merci pour ton email, il a bien été envoyé !');
                return $this->render('AppBundle:Default:index.html.twig',array('bonsplans'=>$bonsplans,'formContact' => $this->createForm(new ContactType())->createView()));
            }else{
                //si le formulaire n'est pas valide en plus des erreurs du form
                $this->get('session')->getFlashBag()->add('danger', 'Désolé un problème est survenu.');
                return $this->render('AppBundle:Default:index.html.twig',array('bonsplans'=>$bonsplans,'formContact' => $formContact->createView()));
            }
        }

        return $this->render('AppBundle:Default:index.html.twig', array(
            // on renvoi dans la vue "la vue" du formulaire
            'formContact' => $formContact->createView(),
            'bonsplans'=>$bonsplans
        ));
    }



}


   
