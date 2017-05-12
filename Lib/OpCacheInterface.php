<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 9:47 PM
 */

namespace Glushko\OpCacheManagement\Lib;

/**
 * Interface OpCacheInterface
 */
interface OpCacheInterface
{
    /**
     * @param $filePath
     *
     * @return bool
     */
    public function compile($filePath);

    /**
     * @param string $filePath
     * @param bool $isForce
     *
     * @return bool
     */
    public function invalidate($filePath, $isForce = false);

    /**
     * @return bool
     */
    public function reset();

    /**
     * @return array
     */
    public function getStatus();

    /**
     * @return array
     */
    public function getConfiguration();

    /**
     * @param string $filePath
     *
     * @return bool
     */
    public function isCached($filePath);
}