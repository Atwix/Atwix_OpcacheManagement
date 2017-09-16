<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Controller\Adminhtml\Management;

use Glushko\OpcacheManagement\Service\Opcache\Management\OpcacheManagement;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context as BackendActionContext;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Encryption\UrlCoder;

/**
 * Class InvalidateCachedScript
 */
class InvalidateCachedScript extends Action
{
    /**
     * @var OpcacheManagement
     */
    protected $opcacheManagement;

    /**
     * @var UrlCoder
     */
    protected $urlCoder;

    /**
     * InvalidateCachedScript constructor.
     *
     * @param BackendActionContext $context
     * @param OpcacheManagement $opcacheManagement
     * @param UrlCoder $urlCoder
     */
    public function __construct(
        BackendActionContext $context,
        OpcacheManagement $opcacheManagement,
        UrlCoder $urlCoder
    ) {
        parent::__construct($context);

        $this->opcacheManagement = $opcacheManagement;
        $this->urlCoder = $urlCoder;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $scriptPath = $this->getScriptPath();

        /** @var RedirectResult $redirectResult */
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResult->setPath('*/*/index');

        if ($this->opcacheManagement->invalidateCachedScript($scriptPath, true)) {

            $this->messageManager->addSuccessMessage(
                __('%1 has been invalidated.', $scriptPath)
            );

        } else {

            $this->messageManager->addErrorMessage(
                __('%1 could\'t be invalidated.', $scriptPath)
            );

        }

        return $redirectResult;
    }

    /**
     * Retrieve the script path to invalidate
     *
     * @return string
     */
    protected function getScriptPath()
    {
        return  $this->urlCoder->decode($this->getRequest()->getParam('script_path'));
    }
}