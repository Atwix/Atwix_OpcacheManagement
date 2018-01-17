<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Information;

use Atwix\OpcacheManagement\Data\Opcache\OpcacheVersionData;
use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;
use Atwix\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheVersionDataMapper;

/**
 * Class GetOpcacheVersion
 */
class GetOpcacheVersionService
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * @var ArrayToOpcacheVersionDataMapper
     */
    protected $arrayToOpcacheVersionDataMapper;

    /**
     * GetOpcacheVersion constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     * @param ArrayToOpcacheVersionDataMapper $arrayToOpcacheVersionDataMapper
     */
    public function __construct(
        OpcacheLibInterface $opcacheWrapper,
        ArrayToOpcacheVersionDataMapper $arrayToOpcacheVersionDataMapper
    ) {
        $this->opcacheWrapper = $opcacheWrapper;
        $this->arrayToOpcacheVersionDataMapper = $arrayToOpcacheVersionDataMapper;
    }

    /**
     * Retrieves information regarding version of Opcache
     *
     * @return OpcacheVersionData
     */
    public function execute()
    {
        $configurationData = $this->opcacheWrapper->getConfiguration();

        return $this->arrayToOpcacheVersionDataMapper->map($configurationData);
    }

}