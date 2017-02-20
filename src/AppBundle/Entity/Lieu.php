<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity
 */
class Lieu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;


    /**
     * @var string
     *
     * @ORM\Column(name="commune", type="string", length=255)
     */
    private $commune;


    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=10)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15)
     */
    private $telephone;



    /**
     * @var ArrayCollection $evenementsLieu
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evenement", mappedBy="lieu")
     */
    private $evenementsLieu;


    private $lieux;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Constructor
     */
    public function __construct()
    {

        $this->evenementsLieu = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evenementsLieu
     *
     * @param \AppBundle\Entity\Evenement $evenementsLieu
     *
     * @return Lieu
     */
    public function addEvenementsLieu(\AppBundle\Entity\Evenement $evenementsLieu)
    {
        $this->evenementsLieu[] = $evenementsLieu;

        return $this;
    }

    /**
     * Remove evenementsLieu
     *
     * @param \AppBundle\Entity\Evenement $evenementsLieu
     */
    public function removeEvenementsLieu(\AppBundle\Entity\Evenement $evenementsLieu)
    {
        $this->evenementsLieu->removeElement($evenementsLieu);
    }

    /**
     * Get evenementsLieu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenementsLieu()
    {
        return $this->evenementsLieu;
    }

    public function getLieux()
    {
        //On déclare notre tableau avec l'ensemble des données GrandLyon
        $url = __DIR__."/data/all.json";

        $contents = file_get_contents($url);
        $contents = utf8_encode($contents);
        $this->lieux = json_decode($contents, true);
        return $this->lieux;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Lieu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Lieu
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set commune
     *
     * @param string $commune
     *
     * @return Lieu
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Lieu
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Lieu
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }


    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return ($this->nom.' '.$this->adresse.' '.$this->codePostal.' - '.$this->commune);
    }

}
