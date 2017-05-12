<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 10:46 PM
 */

namespace Glushko\OpCacheManagement\Block\Adminhtml\Management;

use Magento\Backend\Block\Widget\Form\Container as BackendFormContainer;

/**
 * Class Index
 */
class Index extends BackendFormContainer
{
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'Glushko_OpCacheManagement';
        $this->_controller = 'Adminhtml_Management';
        $this->_mode = 'index';
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {

        return parent::_prepareLayout();
    }
}