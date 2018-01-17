<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Management\Compilation;

use Magento\Framework\App\Filesystem\DirectoryList as AppFilesystemDirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Config\Composer\Package as ComposerPackage;
use Magento\Framework\Config\Composer\PackageFactory;
use Magento\Framework\Filesystem\Directory\ReadFactory as DirectoryReadFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Module\ModuleListInterface;
use Magento\SampleData\Model\Dependency;

/**
 * Class GetScriptSourceDirectoriesService
 */
class GetScriptSourceDirectoriesService
{
    /**
     * List of sample data module packages
     *
     * @var array|false
     */
    protected $sampleDataModulePackages = false;

    /**
     * @var ModuleListInterface
     */
    protected $moduleList;

    /**
     * @var ComponentRegistrarInterface
     */
    protected $componentRegistrar;

    /**
     * @var DirectoryReadFactory
     */
    protected $directoryReaderFactory;

    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var Dependency
     */
    protected $sampleDataDependency;

    /**
     * @var PackageFactory
     */
    protected $packageFactory;

    /**
     * GetScriptSourceDirectoriesService constructor.
     *
     * @param ModuleListInterface $moduleList
     * @param ComponentRegistrarInterface $componentRegistrar
     * @param DirectoryReadFactory $directoryReaderFactory
     * @param DirectoryList $directoryList
     * @param Dependency $sampleDataDependency
     * @param PackageFactory $packageFactory
     */
    public function __construct(
        ModuleListInterface $moduleList,
        ComponentRegistrarInterface $componentRegistrar,
        DirectoryReadFactory $directoryReaderFactory,
        DirectoryList $directoryList,
        Dependency $sampleDataDependency,
        PackageFactory $packageFactory
    ) {
        $this->moduleList = $moduleList;
        $this->componentRegistrar = $componentRegistrar;
        $this->directoryReaderFactory = $directoryReaderFactory;
        $this->directoryList = $directoryList;
        $this->sampleDataDependency = $sampleDataDependency;
        $this->packageFactory = $packageFactory;
    }

    /**
     * Retrieve list of directories where php files should be searched in
     *
     * @return string[]
     */
    public function execute()
    {
        // todo: maybe change priority
        $result = $this->getEnabledModuleDirectories();
        $result[] = $this->getFrameworkDirectory();
        $result[] = $this->getGenerationDirectory();

        return $result;
    }

    /**
     * Retrieve directories of enabled modules
     *
     * @param bool $includeSampleDataModules
     *
     * @return string[]
     */
    protected function getEnabledModuleDirectories($includeSampleDataModules = false)
    {
        $result = [];

        /** @var string $moduleName */
        foreach ($this->moduleList->getAll() as $moduleName => $moduleMetadata) {
            $moduleDirectory = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, $moduleName);
            $composerPackageName = $this->getComposerPackageName($moduleDirectory);

            if ($includeSampleDataModules ||
                (!$includeSampleDataModules && !$this->isSampleDataModule($composerPackageName))
            ) {
                $result[] = $moduleDirectory;
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getFrameworkDirectory()
    {
        $generationDirectoryReader = $this->directoryReaderFactory->create(
            $this->directoryList->getPath(AppFilesystemDirectoryList::LIB_INTERNAL)
        );

        return $generationDirectoryReader->getAbsolutePath();
    }

    /**
     * @return string
     */
    protected function getGenerationDirectory()
    {
        $generationDirectoryReader = $this->directoryReaderFactory->create(
            $this->directoryList->getPath(AppFilesystemDirectoryList::GENERATION)
        );

        return $generationDirectoryReader->getAbsolutePath();
    }

    /**
     * @param string $modulePackageName
     *
     * @return bool
     */
    protected function isSampleDataModule($modulePackageName)
    {
        return in_array($modulePackageName, $this->getSampleDataModulePackages());
    }

    /**
     * Retrieve list of sample data modules
     *
     * @return array
     */
    protected function getSampleDataModulePackages()
    {
        if (!$this->sampleDataModulePackages) {
            $this->sampleDataModulePackages = array_keys($this->sampleDataDependency->getSampleDataPackages());
        }

        return $this->sampleDataModulePackages;
    }

    /**
     * @param string $moduleDirectory
     *
     * @return string
     */
    protected function getComposerPackageName($moduleDirectory)
    {
        $file = $moduleDirectory . '/composer.json';
        $package = $this->getModuleComposerPackage($file);

        return $package->get('name');
    }

    /**
     * Load package
     *
     * @param string $file
     *
     * @return ComposerPackage
     */
    protected function getModuleComposerPackage($file)
    {
        return $this->packageFactory->create([
            'json' => json_decode(file_get_contents($file))
        ]);
    }
}