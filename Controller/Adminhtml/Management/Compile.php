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

/**
 * Class Compile
 */
class Compile extends Action
{
    /**
     * @var OpcacheManagement
     */
    protected $opcacheManagement;

    /**
     * Index constructor.
     *
     * @param BackendActionContext $context
     * @param OpcacheManagement $opcacheManagement
     */
    public function __construct(
        BackendActionContext $context,
        OpcacheManagement $opcacheManagement
    ) {
        parent::__construct($context);

        $this->opcacheManagement = $opcacheManagement;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var RedirectResult $redirectResult */
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResult->setPath('*/*/index');

        //

        return $redirectResult;
    }
}