<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Information;

use Atwix\OpcacheManagement\Data\Opcache\OpcacheMemoryUsageData;
use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;
use Atwix\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheMemoryUsageDataMapper;

/**
 * Class GetOpcacheMemoryUsageService
 */
class GetOpcacheMemoryUsageService
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * @var ArrayToOpcacheMemoryUsageDataMapper
     */
    protected $arrayToOpcacheMemoryUsageDataMapper;

    /**
     * GetOpcacheMemoryUsageService constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     * @param ArrayToOpcacheMemoryUsageDataMapper $arrayToOpcacheMemoryUsageDataMapper
     */
    public function __construct(
        OpcacheLibInterface $opcacheWrapper,
        ArrayToOpcacheMemoryUsageDataMapper $arrayToOpcacheMemoryUsageDataMapper
    ) {
        $this->opcacheWrapper = $opcacheWrapper;
        $this->arrayToOpcacheMemoryUsageDataMapper = $arrayToOpcacheMemoryUsageDataMapper;
    }

    /**
     * Retrieves information regarding memory usage of Opcache
     *
     * @return OpcacheMemoryUsageData
     */
    public function execute()
    {
        $statusData = $this->opcacheWrapper->getStatus();

        return $this->arrayToOpcacheMemoryUsageDataMapper->map($statusData);
    }

}