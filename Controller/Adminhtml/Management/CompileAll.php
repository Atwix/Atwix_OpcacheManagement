<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Controller\Adminhtml\Management;

use Glushko\OpcacheManagement\Service\Filesystem\GetPhpScriptsByDirectoryService;
use Glushko\OpcacheManagement\Service\Opcache\Management\Compilation\FilterScriptsToCompileService;
use Glushko\OpcacheManagement\Service\Opcache\Management\Compilation\GetScriptSourceDirectoriesService;
use Glushko\OpcacheManagement\Service\Opcache\Management\OpcacheManagement;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context as BackendActionContext;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class CompileAll
 */
class CompileAll extends Action
{
    /**
     * @var OpcacheManagement
     */
    protected $opcacheManagement;

    /**
     * @var GetScriptSourceDirectoriesService
     */
    protected $getScriptSourceDirectoriesService;

    /**
     * @var GetPhpScriptsByDirectoryService
     */
    protected $getPhpScriptsByDirectoryService;

    /**
     * @var FilterScriptsToCompileService
     */
    private $filterScriptsToCompileService;

    /**
     * Index constructor.
     *
     * @param BackendActionContext $context
     * @param OpcacheManagement $opcacheManagement
     * @param GetScriptSourceDirectoriesService $getScriptSourceDirectoriesService
     * @param GetPhpScriptsByDirectoryService $getPhpScriptsByDirectoryService
     * @param FilterScriptsToCompileService $filterScriptsToCompileService
     */
    public function __construct(
        BackendActionContext $context,
        OpcacheManagement $opcacheManagement,
        GetScriptSourceDirectoriesService $getScriptSourceDirectoriesService,
        GetPhpScriptsByDirectoryService $getPhpScriptsByDirectoryService,
        FilterScriptsToCompileService $filterScriptsToCompileService
    ) {
        parent::__construct($context);

        $this->opcacheManagement = $opcacheManagement;
        $this->getScriptSourceDirectoriesService = $getScriptSourceDirectoriesService;
        $this->getPhpScriptsByDirectoryService = $getPhpScriptsByDirectoryService;
        $this->filterScriptsToCompileService = $filterScriptsToCompileService;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var RedirectResult $redirectResult */
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResult->setPath('*/*/index');

        $sourceDirectories = $this->getScriptSourceDirectoriesService->execute();
        $countOfCompiledScripts = 0;

        try {
            /** @var string $sourceDirectory */
            foreach ($sourceDirectories as $sourceDirectory) {
                $scriptsToCompile = $this->getPhpScriptsByDirectoryService->execute($sourceDirectory);
                $scriptsToCompile = $this->filterScriptsToCompileService->execute($scriptsToCompile);

                /** @var string $scriptPath */
                foreach ($scriptsToCompile as $scriptPath) {
                    $this->opcacheManagement->compileScript($scriptPath);
                    $countOfCompiledScripts++;
                }
            }

            $this->messageManager->addSuccessMessage(
                __('A total of %1 script(s) has been compiled.', $countOfCompiledScripts)
            );

        } catch (\Exception $ex) {
            $this->messageManager->addErrorMessage($ex->getMessage());
        }

        return $redirectResult;
    }
}