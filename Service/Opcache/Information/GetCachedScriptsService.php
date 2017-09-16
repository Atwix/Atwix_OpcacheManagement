<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;

/**
 * Class GetCachedScriptsService
 */
class GetCachedScriptsService
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * GetCachedScriptsService constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     */
    public function __construct(
        OpcacheLibInterface $opcacheWrapper
    ) {
        $this->opcacheWrapper = $opcacheWrapper;
    }

    /**
     * Retrieves information regarding memory usage of Opcache
     *
     * @return array
     */
    public function execute()
    {
        $statusData = $this->opcacheWrapper->getStatus();

        return array_key_exists('scripts', $statusData) ? $statusData['scripts'] : [];
    }

}