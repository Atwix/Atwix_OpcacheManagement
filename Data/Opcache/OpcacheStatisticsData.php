<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Data\Opcache;

/**
 * Class OpcacheStatisticsData
 */
class OpcacheStatisticsData
{
    /**
     * @var int
     */
    protected $numberCachedScripts;

    /**
     * @var int
     */
    protected $numberCachedKeys;

    /**
     * @var int
     */
    protected $maxCachedKeys;

    /**
     * @var int
     */
    protected $hits;

    /**
     * @var int
     */
    protected $oomRestarts;

    /**
     * @var int
     */
    protected $manualRestarts;

    /**
     * @var int
     */
    protected $startTime;

    /**
     * @var int
     */
    protected $lastRestartTime;

    /**
     * @return int
     */
    public function getNumberCachedScripts()
    {
        return $this->numberCachedScripts;
    }

    /**
     * @param int $numberCachedScripts
     *
     * @return void
     */
    public function setNumberCachedScripts($numberCachedScripts)
    {
        $this->numberCachedScripts = $numberCachedScripts;
    }

    /**
     * @return int
     */
    public function getNumberCachedKeys()
    {
        return $this->numberCachedKeys;
    }

    /**
     * @param int $numberCachedKeys
     *
     * @return void
     */
    public function setNumberCachedKeys($numberCachedKeys)
    {
        $this->numberCachedKeys = $numberCachedKeys;
    }

    /**
     * @return int
     */
    public function getMaxCachedKeys()
    {
        return $this->maxCachedKeys;
    }

    /**
     * @param int $maxCachedKeys
     *
     * @return void
     */
    public function setMaxCachedKeys($maxCachedKeys)
    {
        $this->maxCachedKeys = $maxCachedKeys;
    }

    /**
     * @return int
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param int $hits
     *
     * @return void
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * @return int
     */
    public function getOomRestarts()
    {
        return $this->oomRestarts;
    }

    /**
     * @param int $oomRestarts
     *
     * @return void
     */
    public function setOomRestarts($oomRestarts)
    {
        $this->oomRestarts = $oomRestarts;
    }

    /**
     * @return int
     */
    public function getManualRestarts()
    {
        return $this->manualRestarts;
    }

    /**
     * @param int $manualRestarts
     *
     * @return void
     */
    public function setManualRestarts($manualRestarts)
    {
        $this->manualRestarts = $manualRestarts;
    }

    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     *
     * @return void
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return int
     */
    public function getLastRestartTime()
    {
        return $this->lastRestartTime;
    }

    /**
     * @param int $lastRestartTime
     *
     * @return void
     */
    public function setLastRestartTime($lastRestartTime)
    {
        $this->lastRestartTime = $lastRestartTime;
    }
}