<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheMemoryUsageData;
use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;
use Glushko\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheMemoryUsageDataMapper;

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
     * GetOpcacheVersion constructor.
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