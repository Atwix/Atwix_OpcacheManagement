<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheInterface;

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
     * GetOpcacheVersion constructor.
     *
     * @param OpcacheInterface $opcacheWrapper
     */
    public function __construct(OpcacheInterface $opcacheWrapper)
    {
        $this->opcacheWrapper = $opcacheWrapper;
    }

    /**
     * @return string
     */
    public function getOpcacheProductName()
    {
        $configuration = $this->opcacheWrapper->getConfiguration();

        return $configuration['version']['opcache_product_name'];
    }

    /**
     * @return string
     */
    public function getOpcacheVersion()
    {
        $configuration = $this->opcacheWrapper->getConfiguration();

        return $configuration['version']['version'];
    }

}