<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class CachedScriptsTab
 */
class CachedScriptsTab extends BackendTemplate implements TabWidgetInterface
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Atwix_OpcacheManagement::management/index/tab/cached_scripts_tab.phtml';

    /**
     * @inheritdoc
     */
    public function getTabLabel()
    {
        return __('Cached Scripts');
    }

    /**
     * @inheritdoc
     */
    public function getTabTitle()
    {
        return __('Cached Scripts');
    }

    /**
     * @inheritdoc
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isHidden()
    {
        return false;
    }
}