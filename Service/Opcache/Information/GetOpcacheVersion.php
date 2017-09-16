<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheVersionData;
use Glushko\OpcacheManagement\Lib\OpcacheInterface;
use Glushko\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheVersionDataMapper;

/**
 * Class GetOpcacheVersion
 */
class GetOpcacheVersion
{
    /**
     * @var OpcacheInterface
     */
    protected $opcacheWrapper;

    /**
     * @var ArrayToOpcacheVersionDataMapper
     */
    protected $arrayToOpcacheVersionDataMapper;

    /**
     * GetOpcacheVersion constructor.
     *
     * @param OpcacheInterface $opcacheWrapper
     * @param ArrayToOpcacheVersionDataMapper $arrayToOpcacheVersionDataMapper
     */
    public function __construct(
        OpcacheInterface $opcacheWrapper,
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
        $versionData = $this->opcacheWrapper->getConfiguration();

        return $this->arrayToOpcacheVersionDataMapper->map($versionData);
    }

}