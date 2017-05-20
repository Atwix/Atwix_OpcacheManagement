<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Filesystem;

use Glushko\OpcacheManagement\Service\Filesystem\RecursiveDirectoryIteratorFactory;
use Glushko\OpcacheManagement\Service\Filesystem\RecursiveIteratorIteratorFactory;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * Class GetPhpScriptsByDirectoryService
 */
class GetPhpScriptsByDirectoryService
{

    const FILE_EXTENSION_PHP = 'php';

    /**
     * @var RecursiveIteratorIteratorFactory
     */
    protected $recursiveIteratorIteratorFactory;

    /**
     * @var RecursiveDirectoryIteratorFactory
     */
    protected $recursiveDirectoryIteratorFactory;

    /**
     * GetScriptsToCompileService constructor.
     *
     * @param RecursiveIteratorIteratorFactory $recursiveIteratorIteratorFactory
     * @param RecursiveDirectoryIteratorFactory $recursiveDirectoryIteratorFactory
     */
    public function __construct(
        RecursiveIteratorIteratorFactory $recursiveIteratorIteratorFactory,
        RecursiveDirectoryIteratorFactory $recursiveDirectoryIteratorFactory
    ) {
        $this->recursiveIteratorIteratorFactory = $recursiveIteratorIteratorFactory;
        $this->recursiveDirectoryIteratorFactory = $recursiveDirectoryIteratorFactory;
    }

    /**
     * Retrieve scripts by specified directories
     *
     * @param string $scriptSourceDirectory
     *
     * @return string[]
     */
    public function execute($scriptSourceDirectory)
    {
        $result = [];
        $directoryIterator = $this->recursiveDirectoryIteratorFactory->create($scriptSourceDirectory);
        $iterator = $this->recursiveIteratorIteratorFactory->create(
            $directoryIterator,
            RecursiveIteratorIterator::SELF_FIRST
        );

        /** @var $file SplFileInfo */
        foreach ($iterator as $file) {
            if ($file->isFile() && static::FILE_EXTENSION_PHP === $file->getExtension()) {
                $result[] = $file->getPath() . DIRECTORY_SEPARATOR . $file->getFilename();
            }
        }

        return $result;
    }
}