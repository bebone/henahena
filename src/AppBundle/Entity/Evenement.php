<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu; //On considère que l'utilisateur va mettre beaucoup de texte


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateHeure", type="datetime")
     *
     * @Assert\Range(
     *      min = "now",
     *      max = "+365 days")
     */
    private $dateHeure;


    /**
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User", inversedBy="evenementsCrees")
     *
     */
    private $user; //événement créé par ...


    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Lieu", inversedBy="evenementsLieu")
     *
     */
    private $lieu; //événements à ...


    /**
     * @var ArrayCollection $participants
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Participe", mappedBy="evenement")
     */
    private $participants;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetime")
     */
    private $dateModif;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Evenement
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
     * Set dateHeure
     *
     * @param \DateTime $dateHeure
     *
     * @return Evenement
     */
    public function setDateHeure($dateHeure)
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    /**
     * Get dateHeure
     *
     * @return \DateTime
     */
    public function getDateHeure()
    {
        return $this->dateHeure;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Evenement
     */
    public function setUser(\UserBundle\Entity\User $user = null)
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
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateHeure= new \DateTime();
    }

    /**
     * Add participant
     *
     * @param \AppBundle\Entity\Participe $participant
     *
     * @return Evenement
     */
    public function addParticipant(\AppBundle\Entity\Participe $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \AppBundle\Entity\Participe $participant
     */
    public function removeParticipant(\AppBundle\Entity\Participe $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set lieu
     *
     * @param \AppBundle\Entity\Lieu $lieu
     *
     * @return Evenement
     */
    public function setLieu(\AppBundle\Entity\Lieu $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \AppBundle\Entity\Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Evenement
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
        return $this->contenu;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Evenement
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
}
