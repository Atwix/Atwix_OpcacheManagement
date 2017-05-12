<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 9:47 PM
 */

namespace Glushko\OpCacheManagement\Lib;

/**
 * Class OpCacheWrapper
 */
class OpCacheWrapper implements OpCacheInterface
{
    /**
     * @inheritdoc
     */
    public function compile($filePath)
    {
        return opcache_compile_file($filePath);
    }

    /**
     * @inheritdoc
     */
    public function invalidate($filePath, $isForce = false)
    {
        return opcache_invalidate($filePath, $isForce);
    }

    /**
     * @inheritdoc
     */
    public function reset()
    {
        return opcache_reset();
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return opcache_get_status();
    }

    /**
     * @inheritdoc
     */
    public function getConfiguration()
    {
        return opcache_get_configuration();
    }

    /**
     * @inheritdoc
     */
    public function isCached($filePath)
    {
        return opcache_is_script_cached($filePath);
    }
}