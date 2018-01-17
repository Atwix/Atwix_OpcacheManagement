<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Factory;

use RecursiveDirectoryIterator;

/**
 * Class RecursiveDirectoryIteratorFactory
 */
class RecursiveDirectoryIteratorFactory
{
    /**
     * @param string $path
     * @param int $flags
     *
     * @return RecursiveDirectoryIterator
     */
    public function create($path, $flags = null)
    {
        return new RecursiveDirectoryIterator($path, $flags);
    }
}
