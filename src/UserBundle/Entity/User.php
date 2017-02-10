<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;


    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     */
    private $statut;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=true)
     */
    private $sexe;


    /**
     * @var ArrayCollection $contenuAnnonces
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\contenuAnnonce", mappedBy="user")
     */
    private $contenuAnnonces;


    /**
     * @var ArrayCollection $contenuPages
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\contenuPage", mappedBy="user")
     */
    private $contenuPages;


    /**
     * @var ArrayCollection $evenementsCrees
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evenement", mappedBy="user")
     */
    private $evenementsCrees;


    /**
     * @var ArrayCollection $participations
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Participe", mappedBy="user")
     */
    private $participations;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contenuAnnonces = new ArrayCollection();
        $this->contenuPages = new ArrayCollection();
        $this->evenementsCrees = new ArrayCollection();
        $this->participations = new ArrayCollection();
        parent::__construct();
    }

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
     * Set pseudo
     *
     * @param string $pseudo
     * @return User
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }


    /**
     * Add annonce
     *
     * @param \AppBundle\Entity\contenuAnnonce $contenuAnnonce
     *
     * @return User
     */
    public function addContenuAnnonce(\AppBundle\Entity\contenuAnnonce $contenuAnnonce)
    {
        if (! $this->contenuAnnonces->contains($contenuAnnonce)) {
            $contenuAnnonce->setUser($this);
            $this->contenuAnnonces->add($contenuAnnonce);
        }
        return $this->contenuAnnonces;
    }

    /**
     * Remove annonce
     *
     * @param \AppBundle\Entity\contenuAnnonce $contenuAnnonce
     */
    public function removeContenuAnnonce(\AppBundle\Entity\contenuAnnonce $contenuAnnonce)
    {
        $this->contenuAnnonces->removeElement($contenuAnnonce);
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContenuAnnonces()
    {
        return $this->contenuAnnonces;
    }




    /**
     * Add annonce
     *
     * @param \AppBundle\Entity\contenuPage $contenuPage
     *
     * @return User
     */
    public function addContenuPage(\AppBundle\Entity\contenuPage $contenuPage)
    {
        if (! $this->contenuPages->contains($contenuPage)) {
            $contenuPage->setUser($this);
            $this->contenuPages->add($contenuPage);
        }
        return $this->contenuPages;
    }

    /**
     * Remove annonce
     *
     * @param \AppBundle\Entity\contenuPage $contenuPage
     */
    public function removeContenuPage(\AppBundle\Entity\contenuPage $contenuPage)
    {
        $this->contenuPages->removeElement($contenuPage);
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContenuPages()
    {
        return $this->contenuPages;
    }



    /**
     * Add evenement
     *
     * @param \AppBundle\Entity\Evnemement $evenement
     *
     * @return User
     */
    public function addEvenement(\AppBundle\Entity\Evenement $evenement)
    {
        $this->evenementsCrees[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \AppBundle\Entity\Evenement $evenement
     */
    public function removeEvenement(\AppBundle\Entity\Evenement $evenement)
    {
        $this->evenementsCrees->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenementsCrees;
    }


    /**
     * Add evenementsCree
     *
     * @param \AppBundle\Entity\Evenement $evenementsCree
     *
     * @return User
     */
    public function addEvenementsCree(\AppBundle\Entity\Evenement $evenementsCree)
    {
        $this->evenementsCrees[] = $evenementsCree;

        return $this;
    }

    /**
     * Remove evenementsCree
     *
     * @param \AppBundle\Entity\Evenement $evenementsCree
     */
    public function removeEvenementsCree(\AppBundle\Entity\Evenement $evenementsCree)
    {
        $this->evenementsCrees->removeElement($evenementsCree);
    }

    /**
     * Get evenementsCrees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenementsCrees()
    {
        return $this->evenementsCrees;
    }

    /**
     * Add participation
     *
     * @param \AppBundle\Entity\Participe $participation
     *
     * @return User
     */
    public function addParticipation(\AppBundle\Entity\Participe $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \AppBundle\Entity\Participe $participation
     */
    public function removeParticipation(\AppBundle\Entity\Participe $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get participations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }


    public function getAge() //On calcule à partir de la date de naissance
    {
        $date=$this->getDateNaissance();
        $date_actuelle=date('Y');
        $age = $date_actuelle - $date->format('Y');
        if(date('n')>=$date->format('n') && date('j')>=$date->format('j')) {
            return $age;
        }
            else {
                return $age-1;
            }
    }

    public function setEmail($email){
        parent::setEmail($email);
        $this->setUsername($email);
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return User
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
