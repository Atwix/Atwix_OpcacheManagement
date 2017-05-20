<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Management\Compilation;

/**
 * Class FilterScriptsToCompileService
 */
class FilterScriptsToCompileService
{
    /**
     * Parts of script path that shouldn't be cached
     *
     * @var string[]
     */
    protected $pathPartsToFilter = [
        '/Test/',
        '/Install/',
    ];

    /**
     * Filter scripts that should not be precached
     *
     * @param string[] $scripts
     *
     * @return string[]
     */
    public function execute($scripts)
    {
        $result = [];

        /** @var string $scriptPath */
        foreach ($scripts as $scriptPath) {
            if (!$this->shouldBeFiltered($scriptPath)) {
                $result[] = $scriptPath;
            }
        }

        return $result;
    }

    /**
     * Check if this script should be filtered out from cache
     *
     * @param string $scriptPath
     *
     * @return bool
     */
    protected function shouldBeFiltered($scriptPath)
    {
        $result = false;

        /** @var string $pathPart */
        foreach ($this->pathPartsToFilter as $pathPart) {
            if (false !== strpos($scriptPath, $pathPart)) {
                $result = true;

                break;
            }
        }

        return $result;
    }
}