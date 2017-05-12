<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Glushko\OpCacheManagement\Block\Adminhtml\Management\Index;

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
