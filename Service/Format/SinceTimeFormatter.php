<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Format;

/**
 * Class SinceTimeFormatter
 */
class SinceTimeFormatter
{
    // todo: refactor this

    /**
     *
     * @param int $time
     * @param int $original
     * @param int $extended
     * @param string $text
     *
     * @return string
     */
    public function format($time, $original, $extended = 0, $text = 'ago')
    {
        $time   = $time - $original;
        $day    = $extended ? floor($time / 86400) : round($time / 86400, 0);
        $amount = 0;
        $unit   = '';

        if ($time < 86400) {

            if ($time < 60) {
                $amount = $time;
                $unit   = 'second';
            } elseif ($time < 3600) {
                $amount = floor($time / 60);
                $unit   = 'minute';
            } else {
                $amount = floor($time / 3600);
                $unit   = 'hour';
            }

        } elseif ($day < 14) {
            $amount = $day;
            $unit   = 'day';
        } elseif ($day < 56) {
            $amount = floor($day / 7);
            $unit   = 'week';
        } elseif ($day < 672) {
            $amount = floor($day / 30);
            $unit   = 'month';
        } else {
            $amount = intval(2 * ($day / 365)) / 2;
            $unit   = 'year';
        }

        if ($amount != 1) {
            $unit .= 's';
        }

        if ($extended && $time > 60) {
            $text = ' and ' .
                $this->format(
                    $time,
                    $time < 86400 ? ($time < 3600 ? $amount * 60 : $amount * 3600) : $day * 86400,
                    0,
                    ''
                ) . $text;
        }

        return $amount . ' ' . $unit . ' ' . $text;
    }
}