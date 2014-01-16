<?php

namespace Diet\CoreBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Security\Core\Role\RoleInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 */
class Role implements RoleInterface
{
    /**
     * @var integer
     */
    private $id;

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
     * Get Role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->getName();
    }

    /**
     * @var string
     */
    private $name;

    /**
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roleAdmins;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roleAdmins = new ArrayCollection();
    }

    /**
     * Add roleAdmins
     *
     * @param \Diet\CoreBundle\Entity\Admin $roleAdmins
     * @return Role
     */
    public function addRoleAdmin(\Diet\CoreBundle\Entity\Admin $roleAdmins)
    {
        $this->roleAdmins[] = $roleAdmins;

        return $this;
    }

    /**
     * Remove roleAdmins
     *
     * @param \Diet\CoreBundle\Entity\Admin $roleAdmins
     */
    public function removeRoleAdmin(\Diet\CoreBundle\Entity\Admin $roleAdmins)
    {
        $this->roleAdmins->removeElement($roleAdmins);
    }

    /**
     * Get roleAdmins
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoleAdmins()
    {
        return $this->roleAdmins;
    }
}
