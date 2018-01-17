<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Format;

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