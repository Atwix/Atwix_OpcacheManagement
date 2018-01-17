<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Management;

use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;
use Atwix\OpcacheManagement\Service\Opcache\Information\GetCachedScriptsService;
use Magento\Framework\Filesystem\Io\File as FilesystemFileIo;

/**
 * Class OpcacheManagement
 */
class OpcacheManagement
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * @var FilesystemFileIo
     */
    protected $filesystem;

    /**
     * @var GetCachedScriptsService
     */
    protected $getCachedScriptsService;

    /**
     * OpcacheManagement constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     * @param FilesystemFileIo $filesystem
     * @param GetCachedScriptsService $getCachedScriptsService
     */
    public function __construct(
        OpcacheLibInterface $opcacheWrapper,
        FilesystemFileIo $filesystem,
        GetCachedScriptsService $getCachedScriptsService
    ) {
        $this->opcacheWrapper = $opcacheWrapper;
        $this->filesystem = $filesystem;
        $this->getCachedScriptsService = $getCachedScriptsService;
    }

    /**
     * Flush the entire opcode cache.
     *
     * @return bool
     */
    public function resetCache()
    {
        return $this->opcacheWrapper->reset();
    }

    /**
     * Invalidate cached version of all PHP scripts that are cached
     *
     * @param bool $isForce
     *
     * @return void
     */
    public function invalidateCachedScripts($isForce = false)
    {
        $cachedScripts = $this->getCachedScriptsService->execute();

        foreach ($cachedScripts as $filePath => $cacheData) {
            $this->invalidateCachedScript($filePath, $isForce);
        }
    }

    /**
     * Invalidate cached version of existing PHP script
     *
     * @param string $filePath
     * @param bool $isForce
     *
     * @return bool
     */
    public function invalidateCachedScript($filePath, $isForce = false)
    {
        $result = false;

        if ($this->filesystem->fileExists($filePath)) {
            return $this->opcacheWrapper->invalidate($filePath, $isForce);
        }

        return $result;
    }

    /**
     * Compile a script
     *
     * @param string $filePath
     *
     * @return bool
     */
    public function compileScript($filePath)
    {
        $cachedScripts = $this->getCachedScriptsService->execute();

        if (array_key_exists($filePath, $cachedScripts)) {
            return true;
        }

        return $this->opcacheWrapper->compile($filePath);
    }
}