<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Lib;

/**
 * Class OpcacheLib
 */
class OpcacheLib implements OpcacheLibInterface
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

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return extension_loaded('Zend OPcache') &&
                (ini_get('opcache.enable') || ini_get('opcache.enable_cli'));
    }

    /**
     * @inheritdoc
     */
    public function isCliEnabled()
    {
        return extension_loaded('Zend OPcache') && ini_get('opcache.enable_cli');
    }

    /**
     * @inheritdoc
     */
    public function isInvalidationAvailable()
    {
        return function_exists('opcache_invalidate');
    }

    /**
     * @inheritdoc
     */
    public function isCompilationAvailable()
    {
        return function_exists('opcache_compile_file');
    }
}