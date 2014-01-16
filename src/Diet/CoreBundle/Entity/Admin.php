<?php

namespace Diet\CoreBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Admin
 */
class Admin implements UserInterface, \Serializable
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
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * Set username
     *
     * @param string $username
     * @return Admin
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Admin
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Admin
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
                $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list($this->id, ) = unserialize($serialized);
    }

    /**
     * @var string
     */
    private $email;

    /**
     * Set email
     *
     * @param string $email
     * @return Admin
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Admin
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $adminRoles;
    /**
     * construct
     */
    public function __construct()
    {
        $this->adminRoles = new ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * Add adminRoles
     *
     * @param \Diet\CoreBundle\Entity\Role $adminRoles
     * @return Admin
     */
    public function addAdminRole(\Diet\CoreBundle\Entity\Role $adminRoles)
    {
        $this->adminRoles[] = $adminRoles;

        return $this;
    }

    /**
     * Remove adminRoles
     *
     * @param \Diet\CoreBundle\Entity\Role $adminRoles
     */
    public function removeAdminRole(\Diet\CoreBundle\Entity\Role $adminRoles)
    {
        $this->adminRoles->removeElement($adminRoles);
    }

    /**
     * Get adminRoles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdminRoles()
    {
        return $this->adminRoles;
    }
    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->getAdminRoles()->toArray();
    }

}
