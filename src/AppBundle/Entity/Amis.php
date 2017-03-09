<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amis
 *
 * @ORM\Table(name="amis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AmisRepository")
 */
class Amis
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userAmi;

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
     * @return Amis
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
     * Set userAmi
     *
     * @param \UserBundle\Entity\User $userAmi
     *
     * @return Amis
     */
    public function setUserAmi(\UserBundle\Entity\User $userAmi)
    {
        $this->userAmi = $userAmi;

        return $this;
    }

    /**
     * Get userAmi
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserAmi()
    {
        return $this->userAmi;
    }
}
