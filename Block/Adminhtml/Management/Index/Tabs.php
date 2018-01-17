<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Block\Adminhtml\Management\Index;

use Magento\Backend\Block\Widget\Tabs as TabsWidget;

/**
 * Theme editor tab container
 */
class Tabs extends TabsWidget
{
    /**
     * @inheritdoc
     */
    public function _construct()
    {
        parent::_construct();

        $this->setData('id', 'atwix_opcache_management_tabs');
        $this->setDestElementId('atwix_management_container');
        $this->setData('title', __('Information'));
    }
}
