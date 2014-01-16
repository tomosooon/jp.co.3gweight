<?php

namespace Diet\CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * WeightMachine
 */
class WeightMachine
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
     * @var \Diet\CoreBundle\Entity\Weight
     */
    private $weightuser;


    /**
     * Set weightuser
     *
     * @param \Diet\CoreBundle\Entity\Weight $weightuser
     * @return WeightMachine
     */
    public function setWeightuser(\Diet\CoreBundle\Entity\Weight $weightuser = null)
    {
        $this->weightuser = $weightuser;
    
        return $this;
    }

    /**
     * Get weightuser
     *
     * @return \Diet\CoreBundle\Entity\Weight 
     */
    public function getWeightuser()
    {
        return $this->weightuser;
    }
    /**
     * @var string
     */
    private $machineid;


    /**
     * Set machineid
     *
     * @param string $machineid
     * @return WeightMachine
     */
    public function setMachineid($machineid)
    {
        $this->machineid = $machineid;
    
        return $this;
    }

    /**
     * Get machineid
     *
     * @return string 
     */
    public function getMachineid()
    {
        return $this->machineid;
    }
}