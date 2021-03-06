<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Controller\Adminhtml\Management;

use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context as AppActionContext;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page as PageResult;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheLib;

    /**
     * Index constructor.
     *
     * @param AppActionContext $context
     * @param OpcacheLibInterface $opcacheLib
     */
    public function __construct(
        AppActionContext $context,
        OpcacheLibInterface $opcacheLib
    ) {
        parent::__construct($context);

        $this->opcacheLib = $opcacheLib;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        if (!$this->opcacheLib->isEnabled()) {

            $this->messageManager->addErrorMessage(__('Opcache is disabled. Please check your configurations'));

            /** @var RedirectResult $redirectResult */
            $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $redirectResult->setRefererUrl();

            return $redirectResult;
        }

        /** @var PageResult $pageResult */
        $pageResult = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $pageResult->setActiveMenu('Atwix_OpcacheManagement::Opcache_management');
        $pageResult->getConfig()->getTitle()->prepend(__('Opcache Management'));

        return $pageResult;
    }
}