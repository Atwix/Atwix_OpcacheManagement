<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheVersionData;
use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;
use Glushko\OpcacheManagement\Mapper\Opcache\ArrayToOpcacheVersionDataMapper;

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