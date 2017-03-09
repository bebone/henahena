<?php
namespace AppBundle\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     *
     * @Assert\NotBlank()
     *
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     */
    protected $nom;



    /**
     * @Assert\NotBlank()
     */
    protected $sujet;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }


    public function getSujet(){
        return $this->sujet;
    }

    public function setSujet($sujet){
        $this->sujet = $sujet;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        $this->message = $message;
    }

}