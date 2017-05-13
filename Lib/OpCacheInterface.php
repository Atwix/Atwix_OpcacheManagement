<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 9:47 PM
 */

namespace Glushko\OpcacheManagement\Lib;

/**
 * Interface OpcacheInterface
 */
interface OpcacheInterface
{
    /**
     * @param $filePath
     *
     * @return bool
     */
    public function compile($filePath);

    /**
     * This method invalidates a particular script from the opcode cache.
     * If force is unset or FALSE,
     * the script will only be invalidated if the modification time of the script is newer than the cached opcodes.
     *
     * @param string $filePath
     * @param bool $isForce
     *
     * @return bool
     */
    public function invalidate($filePath, $isForce = false);

    /**
     * This method resets the entire opcode cache.
     * After calling, all scripts will be reloaded and reparsed the next time they are hit.
     *
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

    /**
     * Check if Zend OPcache is enabled
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Check if the current version of Opcache supports invalidation of compiled files
     *
     * @return bool
     */
    public function isInvalidationAvailable();

    /**
     * Check if compilation is available for this version of Opcache
     *
     * @return mixed
     */
    public function isCompilationAvailable();
}