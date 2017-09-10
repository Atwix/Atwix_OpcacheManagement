<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheInterface;

/**
 * Class GetOpcacheStatus
 */
class GetOpcacheStatus
{
    /**
     * @var OpcacheInterface
     */
    protected $opcacheWrapper;

    /**
     * GetOpcacheVersion constructor.
     *
     * @param OpcacheInterface $opcacheWrapper
     */
    public function __construct(OpcacheInterface $opcacheWrapper)
    {
        $this->opcacheWrapper = $opcacheWrapper;
    }

    /**
     * @return bool
     */
    public function isOpcacheEnabled()
    {
        $status = $this->getOpcacheStatus();

        return $status['opcache_enabled'];
    }

    /**
     * @return bool
     */
    public function isCacheFull()
    {
        $status = $this->getOpcacheStatus();

        return $status['cache_full'];
    }

    /**
     * @return bool
     */
    public function isRestartPending()
    {
        $status = $this->getOpcacheStatus();

        return $status['restart_pending'];
    }

    /**
     * @return bool
     */
    public function isRestartInProgress()
    {
        $status = $this->getOpcacheStatus();

        return $status['restart_in_progress'];
    }

    /**
     * @return array
     */
    public function getMemoryUsage()
    {
        $status = $this->getOpcacheStatus();

        return $status['memory_usage'];
    }

    /**
     * @return array
     */
    public function getInternedStringsUsage()
    {
        $status = $this->getOpcacheStatus();

        return $status['interned_strings_usage'];
    }

    /**
     * @return array
     */
    public function getStatistics()
    {
        $status = $this->getOpcacheStatus();

        return $status['opcache_statistics'];
    }

    /**
     * @return array
     */
    public function getCachedScripts()
    {
        $status = $this->getOpcacheStatus();

        return $status['scripts'];
    }

    /**
     * @return array
     */
    protected function getOpcacheStatus()
    {
        return $this->opcacheWrapper->getStatus(); // todo: add lazy loading
    }
}