<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\DateTime;

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
