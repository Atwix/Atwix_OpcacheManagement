<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Data\Opcache;

/**
 * Class OpcacheMemoryUsageData
 */
class OpcacheMemoryUsageData
{
    /**
     * @var string
     */
    protected $usedMemory;

    /**
     * @var string
     */
    protected $freeMemory;

    /**
     * @var string
     */
    protected $wastedMemory;

    /**
     * @var string
     */
    protected $currentWastedPercentage;

    /**
     * @return string
     */
    public function getUsedMemory()
    {
        return $this->usedMemory;
    }

    /**
     * @param string $usedMemory
     *
     * @return void
     */
    public function setUsedMemory($usedMemory)
    {
        $this->usedMemory = $usedMemory;
    }

    /**
     * @return string
     */
    public function getFreeMemory()
    {
        return $this->freeMemory;
    }

    /**
     * @param string $freeMemory
     *
     * @return void
     */
    public function setFreeMemory($freeMemory)
    {
        $this->freeMemory = $freeMemory;
    }

    /**
     * @return string
     */
    public function getWastedMemory()
    {
        return $this->wastedMemory;
    }

    /**
     * @param string $wastedMemory
     *
     * @return void
     */
    public function setWastedMemory($wastedMemory)
    {
        $this->wastedMemory = $wastedMemory;
    }

    /**
     * @return string
     */
    public function getCurrentWastedPercentage()
    {
        return $this->currentWastedPercentage;
    }

    /**
     * @param string $currentWastedPercentage
     *
     * @return void
     */
    public function setCurrentWastedPercentage($currentWastedPercentage)
    {
        $this->currentWastedPercentage = $currentWastedPercentage;
    }
}