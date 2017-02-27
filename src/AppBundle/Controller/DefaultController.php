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
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request) //temporaire
    {
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
                $this->get('session')->getFlashBag()->add('info', 'Merci pour votre email !');
            }else{
                //si le formulaire n'est pas valide en plus des erreurs du form
                $this->get('session')->getFlashBag()->add('danger', 'Désolé un problème est survenu.');

            }
        }

        return $this->render('AppBundle::contact.html.twig', array(
            // on renvoi dans la vue "la vue" du formulaire
            'formContact' => $formContact->createView()
        ));

    }




}


   
