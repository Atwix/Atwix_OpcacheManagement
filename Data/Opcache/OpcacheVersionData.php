<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Data\Opcache;

/**
 * Class OpcacheVersionData
 */
class OpcacheVersionData
{
    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $productName;

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return void
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     *
     * @return void
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }
}