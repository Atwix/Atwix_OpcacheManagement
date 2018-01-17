<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Information;

use Atwix\OpcacheManagement\Data\Opcache\OpcacheStatisticsData;
use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;
use Atwix\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheStatisticsDataMapper;

/**
 * Class GetOpcacheStatisticsService
 */
class GetOpcacheStatisticsService
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * @var ArrayToOpcacheStatisticsDataMapper
     */
    protected $arrayToOpcacheStatisticsDataMapper;

    /**
     * GetOpcacheStatisticsService constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     * @param ArrayToOpcacheStatisticsDataMapper $arrayToOpcacheStatisticsDataMapper
     */
    public function __construct(
        OpcacheLibInterface $opcacheWrapper,
        ArrayToOpcacheStatisticsDataMapper $arrayToOpcacheStatisticsDataMapper
    ) {
        $this->opcacheWrapper = $opcacheWrapper;
        $this->arrayToOpcacheStatisticsDataMapper = $arrayToOpcacheStatisticsDataMapper;
    }

    /**
     * Retrieves information regarding memory usage of Opcache
     *
     * @return OpcacheStatisticsData
     */
    public function execute()
    {
        $statusData = $this->opcacheWrapper->getStatus();

        return $this->arrayToOpcacheStatisticsDataMapper->map($statusData);
    }

}