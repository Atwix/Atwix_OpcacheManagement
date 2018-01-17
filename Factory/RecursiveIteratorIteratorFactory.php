<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Factory;

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
