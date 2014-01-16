<?php

namespace Diet\CoreBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weight
 */
class Weight implements UserInterface, \Serializable
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
    private $email;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $adminRoles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }
    
    public function getRoles()
    {
        return array(
                'ROLE_USER'
        );
    }
    


    /**
     * Set email
     *
     * @param string $email
     * @return Weight
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
     * @return Weight
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
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
     * @return Weight
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
     * @return Weight
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
     *
     */
    public function getUsername() {
        return $this->email;
    }
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;


    /**
     * Add users
     *
     * @param \Diet\CoreBundle\Entity\User $users
     * @return Weight
     */
    public function addUser(\Diet\CoreBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Diet\CoreBundle\Entity\User $users
     */
    public function removeUser(\Diet\CoreBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
    /**
     * @var \Diet\CoreBundle\Entity\WeightMachine
     */
    private $weightmachine;


    /**
     * Set weightmachine
     *
     * @param \Diet\CoreBundle\Entity\WeightMachine $weightmachine
     * @return Weight
     */
    public function setWeightmachine(\Diet\CoreBundle\Entity\WeightMachine $weightmachine = null)
    {
        $this->weightmachine = $weightmachine;
    
        return $this;
    }

    /**
     * Get weightmachine
     *
     * @return \Diet\CoreBundle\Entity\WeightMachine 
     */
    public function getWeightmachine()
    {
        return $this->weightmachine;
    }
}