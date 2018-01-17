<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Information;

use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;

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