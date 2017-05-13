<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 9:47 PM
 */

namespace Glushko\OpcacheManagement\Lib;

/**
 * Class OpcacheWrapper
 */
class OpcacheWrapper implements OpcacheInterface
{
    /**
     * @inheritdoc
     */
    public function compile($filePath)
    {
        return Opcache_compile_file($filePath);
    }

    /**
     * @inheritdoc
     */
    public function invalidate($filePath, $isForce = false)
    {
        return Opcache_invalidate($filePath, $isForce);
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        return Opcache_reset();
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return Opcache_get_status();
    }

    /**
     * @inheritdoc
     */
    public function getConfiguration()
    {
        return Opcache_get_configuration();
    }

    /**
     * @inheritdoc
     */
    public function isCached($filePath)
    {
        return Opcache_is_script_cached($filePath);
    }
}