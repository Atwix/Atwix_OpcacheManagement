<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Factory;

use RecursiveIteratorIterator;
use Traversable;

/**
 * Class RecursiveIteratorIteratorFactory
 */
class RecursiveIteratorIteratorFactory
{
    /**
     * @param Traversable $iterator
     * @param int $mode
     * @param int $flags
     *
     * @return RecursiveIteratorIterator
     */
    public function create($iterator, $mode = null, $flags = null)
    {
        return new RecursiveIteratorIterator($iterator, $mode, $flags);
    }
}
