<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Controller\Adminhtml\Management;

use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context as AppActionContext;
use Magento\Framework\Controller\Result\Redirect as RedirectResult;
use Magento\Framework\Controller\ResultFactory;

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

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}