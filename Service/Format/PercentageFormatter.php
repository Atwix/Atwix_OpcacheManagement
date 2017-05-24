<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Format;

/**
 * Class PercentageFormatter
 */
class PercentageFormatter
{
    /**
     * @param float $percentage
     *
     * @return string
     */
    public function format($percentage)
    {
        return round($percentage * 100, 2) . ' %';
    }
}