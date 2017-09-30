<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;

/**
 * Class GetOpcacheBlacklistService
 */
class GetOpcacheBlacklistService
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * GetOpcacheBlacklistService constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     */
    public function __construct(OpcacheLibInterface $opcacheWrapper)
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