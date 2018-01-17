<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Mapper\Opcache;

use Atwix\OpcacheManagement\Data\Opcache\OpcacheMemoryUsageData;
use Atwix\OpcacheManagement\Data\Opcache\OpcacheMemoryUsageDataFactory;

/**
 * Class ArrayToOpcacheMemoryUsageDataMapper
 */
class ArrayToOpcacheMemoryUsageDataMapper
{
    /**
     * @var OpcacheMemoryUsageData
     */
    protected $opcacheMemoryUsageDataFactory;

    /**
     * ArrayToOpcacheMemoryUsageDataMapper constructor.
     *
     * @param OpcacheMemoryUsageDataFactory $opcacheMemoryUsageDataFactory
     */
    public function __construct(
        OpcacheMemoryUsageDataFactory $opcacheMemoryUsageDataFactory
    ) {
        $this->opcacheMemoryUsageDataFactory = $opcacheMemoryUsageDataFactory;
    }

    /**
     * Map array from Opcache API to OpcacheVersionData data model
     *
     * @param array $statusData
     *
     * @return OpcacheMemoryUsageData
     */
    public function map($statusData)
    {
        /** @var OpcacheMemoryUsageData $opcacheMemoryUsageData */
        $opcacheMemoryUsageData = $this->opcacheMemoryUsageDataFactory->create();

        if (!array_key_exists('memory_usage' , $statusData)) {
            return $opcacheMemoryUsageData;
        }

        $memoryUsageData = $statusData['memory_usage'];

        if (array_key_exists('used_memory', $memoryUsageData)) {
            $opcacheMemoryUsageData->setUsedMemory($memoryUsageData['used_memory']);
        }

        if (array_key_exists('free_memory', $memoryUsageData)) {
            $opcacheMemoryUsageData->setFreeMemory($memoryUsageData['free_memory']);
        }

        if (array_key_exists('wasted_memory', $memoryUsageData)) {
            $opcacheMemoryUsageData->setWastedMemory($memoryUsageData['wasted_memory']);
        }

        if (array_key_exists('current_wasted_percentage', $memoryUsageData)) {
            $opcacheMemoryUsageData->setCurrentWastedPercentage($memoryUsageData['current_wasted_percentage']);
        }

        return $opcacheMemoryUsageData;
    }
}