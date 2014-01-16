<?php

namespace Diet\CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * History
 */
class History
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
     * @var integer
     */
    private $weight;

    /**
     * @var \DateTime
     */
    private $messureAt;

    /**
     * @var \Diet\CoreBundle\Entity\User
     */
    private $user;

    /**
     * Set weight
     *
     * @param integer $weight
     * @return History
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set messureAt
     *
     * @param \DateTime $messureAt
     * @return History
     */
    public function setMessureAt($messureAt)
    {
        $this->messureAt = $messureAt;

        return $this;
    }

    /**
     * Get messureAt
     *
     * @return \DateTime 
     */
    public function getMessureAt()
    {
        return $this->messureAt;
    }

    /**
     * Set user
     *
     * @param \Diet\CoreBundle\Entity\User $user
     * @return History
     */
    public function setUser(\Diet\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Diet\CoreBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->messureAt = new \DateTime();
        // Add your code here
    }
}
