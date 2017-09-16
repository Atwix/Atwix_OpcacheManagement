<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheInterface;

/**
 * Class GetOpcacheBlacklistService
 */
class GetOpcacheBlacklistService
{
    /**
     * @var OpcacheInterface
     */
    protected $opcacheWrapper;

    /**
     * GetOpcacheBlacklistService constructor.
     *
     * @param OpcacheInterface $opcacheWrapper
     */
    public function __construct(OpcacheInterface $opcacheWrapper)
    {
        $this->opcacheWrapper = $opcacheWrapper;
    }

    /**
     * Retrieves Opcache blacklist
     *
     * @return array
     */
    public function execute()
    {
        $configurationData = $this->opcacheWrapper->getConfiguration();

        return array_key_exists('blacklist', $configurationData) ? $configurationData['blacklist'] : [];
    }
}