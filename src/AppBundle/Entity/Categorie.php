<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @var ArrayCollection $bonsplans
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bonplan", mappedBy="categorie")
     */
    private $bonsplans;


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
     * @return Categorie
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
     * Constructor
     */
    public function __construct()
    {
        $this->bonsplans = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bon plan
     *
     * @param \AppBundle\Entity\Bonplan $bonplan
     *
     * @return Categorie
     */
    public function addBonplan(\AppBundle\Entity\Bonplan $bonplan)
    {
        $this->bonsplans[] = $bonplan;

        return $this;
    }

    /**
     * Remove bon plan
     *
     * @param \AppBundle\Entity\Bonplan $bonplan
     */
    public function removeBonsplans(\AppBundle\Entity\Bonplan $bonplan)
    {
        $this->bonsplans->removeElement($bonplan);
    }

    /**
     * Get bons plans
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBonsplans()
    {
        return $this->bonsplans;
    }
}
