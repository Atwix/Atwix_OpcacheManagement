<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Data\Opcache;

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
     * @var array
     */
    protected $cachedScripts;
}