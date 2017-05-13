<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/13/17
 * Time: 9:27 AM
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