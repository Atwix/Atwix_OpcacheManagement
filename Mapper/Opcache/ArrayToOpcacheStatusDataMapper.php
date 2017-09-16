<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Mapper\Opcache;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatusData;
use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatusDataFactory;

/**
 * Class ArrayToOpcacheStatusDataMapper
 */
class ArrayToOpcacheStatusDataMapper
{
    /**
     * @var OpcacheStatusData
     */
    protected $opcacheStatusDataFactory;

    /**
     * ArrayToOpcacheStatusDataMapper constructor.
     *
     * @param OpcacheStatusDataFactory $opcacheStatusDataFactory
     */
    public function __construct(
        OpcacheStatusDataFactory $opcacheStatusDataFactory
    ) {
        $this->opcacheStatusDataFactory = $opcacheStatusDataFactory;
    }

    /**
     * Map array from Opcache API to OpcacheStatusData data model
     *
     * @param array $statusData
     *
     * @return OpcacheStatusData
     */
    public function map($statusData)
    {
        /** @var OpcacheStatusData $opcacheStatusData */
        $opcacheStatusData = $this->opcacheStatusDataFactory->create();

        if (array_key_exists('opcache_enabled', $statusData)) {
            $opcacheStatusData->setIsEnabled($statusData['opcache_enabled']);
        }

        if (array_key_exists('cache_full', $statusData)) {
            $opcacheStatusData->setIsCacheFull($statusData['cache_full']);
        }

        if (array_key_exists('restart_pending', $statusData)) {
            $opcacheStatusData->setIsRestartPending($statusData['restart_pending']);
        }

        if (array_key_exists('restart_in_progress', $statusData)) {
            $opcacheStatusData->setIsRestartInProgress($statusData['restart_in_progress']);
        }

        if (array_key_exists('interned_strings_usage', $statusData)) {
            $opcacheStatusData->setInternedStringsUsage($statusData['interned_strings_usage']);
        }

        return $opcacheStatusData;
    }
}