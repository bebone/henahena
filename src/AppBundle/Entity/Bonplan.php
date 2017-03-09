<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="bonplan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BonplanRepository")
 */
class Bonplan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;


    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetime")
     */
    private $dateModif;



    /**
     * @var int
     *
     * @ORM\Column(name="loyer", type="integer", nullable=true)
     */
    private $loyer;


    /**
     * @var float
     *
     * @ORM\Column(name="superficie", type="float", nullable=true)
     */
    private $superficie;


    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;


    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", nullable=true, length=255)
     */
    private $depart;


    /**
     * @var string
     *
     * @ORM\Column(name="arrivee", type="string", nullable=true, length=255)
     */
    private $arrivee;


    /**
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User", inversedBy="bonsplans")
     *
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Categorie", inversedBy="bonsplans")
     *
     */
    private $categorie;


    public function __construct()
    {
        $this->dateModif = new \DateTime();
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return contenuAnnonce
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return contenuAnnonce
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        $output = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, ($this->contenu));
        return $output;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return contenuAnnonce
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Annonce
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set loyer
     *
     * @param integer $loyer
     *
     * @return Bonplan
     */
    public function setLoyer($loyer)
    {
        $this->loyer = $loyer;

        return $this;
    }

    /**
     * Get loyer
     *
     * @return integer
     */
    public function getLoyer()
    {
        return $this->loyer;
    }

    /**
     * Set superficie
     *
     * @param float $superficie
     *
     * @return Bonplan
     */
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;

        return $this;
    }

    /**
     * Get superficie
     *
     * @return float
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Bonplan
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set depart
     *
     * @param string $depart
     *
     * @return Bonplan
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set arrivee
     *
     * @param string $arrivee
     *
     * @return Bonplan
     */
    public function setArrivee($arrivee)
    {
        $this->arrivee = $arrivee;

        return $this;
    }

    /**
     * Get arrivee
     *
     * @return string
     */
    public function getArrivee()
    {
        return $this->arrivee;
    }

    public function getImage()
    {
        if($this->categorie->getId()==1){
            return 'assets/img/img-3.jpg';
        }
        elseif($this->categorie->getId()==2){
            return 'assets/img/img-2.jpg';
        }
        else {
            return 'assets/img/img-7.jpg';
        }

    }


}

