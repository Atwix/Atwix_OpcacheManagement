<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Controller\Adminhtml\Management;

use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;
use Atwix\OpcacheManagement\Service\Opcache\Management\OpcacheManagement;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context as BackendActionContext;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class CheckCache
 */
class CheckCache extends Action
{
    /**
     * @var OpcacheManagement
     */
    protected $opcacheManagement;

    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * CheckCache constructor.
     *
     * @param BackendActionContext $context
     * @param OpcacheLibInterface $opcacheWrapper
     * @param OpcacheManagement $opcacheManagement
     */
    public function __construct(
        BackendActionContext $context,
        OpcacheLibInterface $opcacheWrapper,
        OpcacheManagement $opcacheManagement
    ) {
        parent::__construct($context);

        $this->opcacheManagement = $opcacheManagement;
        $this->opcacheWrapper = $opcacheWrapper;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var RedirectResult $redirectResult */
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResult->setPath('*/*/index');

        if ($this->opcacheWrapper->isInvalidationAvailable()) {
            $this->opcacheManagement->invalidateCachedScripts();
            $this->messageManager->addSuccessMessage(__('The Opcache storage has been checked.'));
        } else {
            $this->messageManager->addWarningMessage(__('This feature is not available for your version of Opcache.'));
        }

        return $redirectResult;
    }
}