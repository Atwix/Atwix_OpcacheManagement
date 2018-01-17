<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Factory;

use DateTime;

/**
 * Class DateTimeFactory
 */
class DateTimeFactory
{
    /**
     * @return DateTime
     */
    public function create()
    {
        return new DateTime();
    }
}
