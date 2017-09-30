<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index;

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

        $this->setData('id', 'glushko_opcache_management_tabs');
        $this->setDestElementId('glushko_management_container');
        $this->setData('title', __('Information'));
    }
}
