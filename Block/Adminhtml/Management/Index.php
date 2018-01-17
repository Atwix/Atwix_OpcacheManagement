<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Block\Adminhtml\Management;

use Magento\Backend\Block\Widget\Container as BackendContainerWidget;

/**
 * Class Index
 */
class Index extends BackendContainerWidget
{
    /**
     * @var string
     */
    protected $containerElementId;

    /**
     * Retrieves the container element Id
     *
     * @return string
     */
    public function getContainerElementId()
    {
        return $this->containerElementId;
    }

    /**
     * Configures the container element Id
     *
     * @param string $containerElementId
     *
     * @return void
     */
    public function setContainerElementId($containerElementId)
    {
        $this->containerElementId = $containerElementId;
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_controller = 'Adminhtml_Management';
        $this->setContainerElementId('atwix_management_container');
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
                    'After pressing, all cached scripts will be reloaded and reparsed the next time they are hit.'),
                'onclick' => 'setLocation(\'' . $this->getResetCacheUrl() . '\')',
                'class' => 'primary',
            ],
            1
        );
        $this->addButton(
            'checkCache',
            [
                'label' => __('Check Cache'),
                'title' => __('It checks the entire opcode cache. ' .
                    'After pressing, all scripts will be checked and they will be invalidated' .
                    ' if modification time is newer the cached one'),
                'onclick' => 'setLocation(\'' . $this->getCheckCacheUrl() . '\')',
                'class' => 'primary',
            ],
            2
        );
        /*$this->addButton(
            'compileAll',
            [
                'label' => __('Compile All Scripts'),
                'title' => __('Compile all PHP scripts in Magento without execution'),
                'onclick' => 'setLocation(\'' . $this->getCompileAllUrl() . '\')',
                'class' => 'primary',
            ],
            3
        );*/

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

    /**
     * @return string
     */
    protected function getCompileAllUrl()
    {
        return $this->getUrl('*/*/compileAll');
    }
}