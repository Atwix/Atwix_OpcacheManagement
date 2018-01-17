<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Data\Opcache;

/**
 * Class OpcacheStatusData
 */
class OpcacheStatusData
{
    /**
     * @var bool
     */
    protected $isEnabled;

    /**
     * @var bool
     */
    protected $isCacheFull;

    /**
     * @return bool
     */
    protected $isRestartPending;

    /**
     * @var bool
     */
    protected $isRestartInProgress;

    /**
     * @var array
     */
    protected $internedStringsUsage;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return bool
     */
    public function isCacheFull()
    {
        return $this->isCacheFull;
    }

    /**
     * @param bool $isCacheFull
     */
    public function setIsCacheFull($isCacheFull)
    {
        $this->isCacheFull = $isCacheFull;
    }

    /**
     * @return bool
     */
    public function isRestartPending()
    {
        return $this->isRestartPending;
    }

    /**
     * @param mixed $isRestartPending
     */
    public function setIsRestartPending($isRestartPending)
    {
        $this->isRestartPending = $isRestartPending;
    }

    /**
     * @return bool
     */
    public function isRestartInProgress()
    {
        return $this->isRestartInProgress;
    }

    /**
     * @param bool $isRestartInProgress
     */
    public function setIsRestartInProgress($isRestartInProgress)
    {
        $this->isRestartInProgress = $isRestartInProgress;
    }

    /**
     * @return array
     */
    public function getInternedStringsUsage()
    {
        return $this->internedStringsUsage;
    }

    /**
     * @param array $internedStringsUsage
     */
    public function setInternedStringsUsage($internedStringsUsage)
    {
        $this->internedStringsUsage = $internedStringsUsage;
    }
}