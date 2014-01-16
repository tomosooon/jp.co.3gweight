<?php

namespace Diet\CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Target
 */
class Target
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
    private $month_target;

    /**
     * @var integer
     */
    private $week_target;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Diet\CoreBundle\Entity\User
     */
    private $user;

    /**
     * Set month_target
     *
     * @param integer $monthTarget
     * @return Target
     */
    public function setMonthTarget($monthTarget)
    {
        $this->month_target = $monthTarget;

        return $this;
    }

    /**
     * Get month_target
     *
     * @return integer 
     */
    public function getMonthTarget()
    {
        return $this->month_target;
    }

    /**
     * Set week_target
     *
     * @param integer $weekTarget
     * @return Target
     */
    public function setWeekTarget($weekTarget)
    {
        $this->week_target = $weekTarget;

        return $this;
    }

    /**
     * Get week_target
     *
     * @return integer 
     */
    public function getWeekTarget()
    {
        return $this->week_target;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Target
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Target
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set user
     *
     * @param \Diet\CoreBundle\Entity\User $user
     * @return Target
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
        $now = new \DateTime();

        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
        // Add your code here
    }
}
