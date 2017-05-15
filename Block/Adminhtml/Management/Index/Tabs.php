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

        $this->setId('theme_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Information'));
    }
}
