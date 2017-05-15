<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management;

use Magento\Backend\Block\Widget\Form\Container as BackendFormContainer;

/**
 * Class Index
 */
class Index extends BackendFormContainer
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_blockGroup = 'Glushko_OpcacheManagement';
        $this->_controller = 'Adminhtml_Management';
        $this->_mode = 'index';
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        $this->buttonList->remove('reset');
        $this->buttonList->remove('delete');
        $this->buttonList->remove('save');

        $this->addButton(
            'resetCache',
            [
                'label' => __('Reset Cache'),
                'title' => __('It resets the entire opcode cache. ' .
                    'After pressing, all scripts will be reloaded and reparsed the next time they are hit.'),
                'onclick' => 'setLocation(\'' . $this->getResetCacheUrl() . '\')',
                'class' => 'primary',
            ],
            1
        );
        $this->addButton(
            'checkCache',
            [
                'label' => __('Check Cache'),
                'title' => __('It resets the entire opcode cache. ' .
                    'After pressing, all scripts will be reloaded and reparsed the next time they are hit.'),
                'onclick' => 'setLocation(\'' . $this->getCheckCacheUrl() . '\')',
                'class' => 'primary',
            ],
            1
        );

        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    protected function getResetCacheUrl()
    {
        return $this->getUrl('*/*/resetCache');
    }

    /**
     * @return string
     */
    protected function getCheckCacheUrl()
    {
        return $this->getUrl('*/*/checkCache');
    }
}