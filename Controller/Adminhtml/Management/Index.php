<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 9:22 PM
 */

namespace Glushko\OpCacheManagement\Controller\Adminhtml\Management;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}