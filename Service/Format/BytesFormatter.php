<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Format;

/**
 * Class BytesFormatter
 */
class BytesFormatter
{
    /**
     * Convert bytes to readable format
     *
     * @param int $bytes
     *
     * @return string
     */
    public function format($bytes)
    {
        $bytes = (int) $bytes;

        if ($bytes > 1024 * 1024) {
            return round($bytes / 1024 / 1024, 2) . ' MB';
        } elseif ($bytes > 1024) {
            return round($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }
}