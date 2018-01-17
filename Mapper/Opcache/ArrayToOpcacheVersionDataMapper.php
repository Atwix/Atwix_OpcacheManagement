<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Mapper\Opcache;

use Atwix\OpcacheManagement\Data\Opcache\OpcacheVersionData;
use Atwix\OpcacheManagement\Data\Opcache\OpcacheVersionDataFactory;

/**
 * Class OpcacheVersionData
 */
class ArrayToOpcacheVersionDataMapper
{
    /**
     * @var OpcacheVersionDataFactory
     */
    protected $opcacheVersionDataFactory;

    /**
     * ArrayToOpcacheVersionDataMapper constructor.
     *
     * @param OpcacheVersionDataFactory $opcacheVersionDataFactory
     */
    public function __construct(
        OpcacheVersionDataFactory $opcacheVersionDataFactory
    ) {
        $this->opcacheVersionDataFactory = $opcacheVersionDataFactory;
    }

    /**
     * Map array from Opcache API to OpcacheVersionData data model
     *
     * @param array $configurationData
     *
     * @return OpcacheVersionData
     */
    public function map($configurationData)
    {
        /** @var OpcacheVersionData $opcacheVersionData */
        $opcacheVersionData = $this->opcacheVersionDataFactory->create();

        if (!array_key_exists('version' , $configurationData)) {
            return $opcacheVersionData;
        }

        $versionData = $configurationData['version'];

        if (array_key_exists('version', $versionData)) {
            $opcacheVersionData->setVersion($versionData['version']);
        }

        if (array_key_exists('opcache_product_name', $versionData)) {
            $opcacheVersionData->setProductName($versionData['opcache_product_name']);
        }

        return $opcacheVersionData;
    }
}