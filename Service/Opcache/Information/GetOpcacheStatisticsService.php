<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatisticsData;
use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;
use Glushko\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheStatisticsDataMapper;

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