<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Management;

use Glushko\OpcacheManagement\Lib\OpcacheInterface;
use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatus;
use Magento\Framework\Filesystem\Io\File as FilesystemFileIo;

/**
 * Class OpcacheManagement
 */
class OpcacheManagement
{
    /**
     * @var OpcacheInterface
     */
    protected $opcacheWrapper;

    /**
     * @var FilesystemFileIo
     */
    protected $filesystem;

    /**
     * @var GetOpcacheStatus
     */
    protected $getOpcacheStatus;

    /**
     * OpcacheManagement constructor.
     *
     * @param OpcacheInterface $opcacheWrapper
     * @param GetOpcacheStatus $getOpcacheStatus
     * @param FilesystemFileIo $filesystem
     */
    public function __construct(
        OpcacheInterface $opcacheWrapper,
        GetOpcacheStatus $getOpcacheStatus,
        FilesystemFileIo $filesystem
    ) {
        $this->opcacheWrapper = $opcacheWrapper;
        $this->filesystem = $filesystem;
        $this->getOpcacheStatus = $getOpcacheStatus;
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
        $cachedScripts = $this->getOpcacheStatus->getCachedScripts();

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
        $cachedScripts = $this->getOpcacheStatus->getCachedScripts();

        if (array_key_exists($filePath, $cachedScripts)) {
            return true;
        }

        return $this->opcacheWrapper->compile($filePath);
    }
}