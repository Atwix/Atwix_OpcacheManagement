<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Mapper\Opcache;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatisticsData;
use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatisticsDataFactory;

/**
 * Class ArrayToOpcacheStatisticsDataMapper
 */
class ArrayToOpcacheStatisticsDataMapper
{
    /**
     * @var OpcacheStatisticsDataFactory
     */
    protected $opcacheStatisticsDataFactory;

    /**
     * ArrayToOpcacheStatisticsDataMapper constructor.
     *
     * @param OpcacheStatisticsDataFactory $opcacheStatisticsDataFactory
     */
    public function __construct(
        OpcacheStatisticsDataFactory $opcacheStatisticsDataFactory
    ) {
        $this->opcacheStatisticsDataFactory = $opcacheStatisticsDataFactory;
    }

    /**
     * Map array from Opcache API to OpcacheVersionData data model
     *
     * @param array $statusData
     *
     * @return OpcacheStatisticsData
     */
    public function map($statusData)
    {
        /** @var OpcacheStatisticsData $opcacheStatisticsData */
        $opcacheStatisticsData = $this->opcacheStatisticsDataFactory->create();

        if (!array_key_exists('opcache_statistics' , $statusData)) {
            return $opcacheStatisticsData;
        }

        $statisticsData = $statusData['opcache_statistics'];

        if (array_key_exists('hits', $statisticsData)) {
            $opcacheStatisticsData->setHits($statisticsData['hits']);
        }

        if (array_key_exists('oom_restarts', $statisticsData)) {
            $opcacheStatisticsData->setOomRestarts($statisticsData['oom_restarts']);
        }

        if (array_key_exists('manual_restarts', $statisticsData)) {
            $opcacheStatisticsData->setManualRestarts($statisticsData['manual_restarts']);
        }

        if (array_key_exists('max_cached_keys', $statisticsData)) {
            $opcacheStatisticsData->setMaxCachedKeys($statisticsData['max_cached_keys']);
        }

        if (array_key_exists('num_cached_keys', $statisticsData)) {
            $opcacheStatisticsData->setNumberCachedKeys($statisticsData['num_cached_keys']);
        }

        if (array_key_exists('num_cached_scripts', $statisticsData)) {
            $opcacheStatisticsData->setNumberCachedScripts($statisticsData['num_cached_scripts']);
        }

        return $opcacheStatisticsData;
    }
}