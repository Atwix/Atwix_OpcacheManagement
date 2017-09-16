<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Controller\Adminhtml\Management;

use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;
use Glushko\OpcacheManagement\Service\Opcache\Management\OpcacheManagement;
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