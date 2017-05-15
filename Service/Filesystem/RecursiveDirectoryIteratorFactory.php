<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Filesystem;

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
