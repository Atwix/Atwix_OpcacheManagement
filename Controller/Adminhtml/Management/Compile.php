<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 9:22 PM
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