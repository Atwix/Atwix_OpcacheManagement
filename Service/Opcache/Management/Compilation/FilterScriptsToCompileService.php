<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Management\Compilation;

/**
 * Class FilterScriptsToCompileService
 */
class FilterScriptsToCompileService
{
    /**
     * Parts of script path that shouldn't be cached
     *
     * @var string[]
     * todo: move to configs
     */
    protected $pathPartsToFilter = [
        '/Test/',
        '/Install/',
        'Magento/Framework/Message/Success.php',
        'Atwix/OpcacheManagement/Controller/Adminhtml/Management/CompileAll.php',
        'atwix/opcache-management/Controller/Adminhtml/Management/CompileAll.php'
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