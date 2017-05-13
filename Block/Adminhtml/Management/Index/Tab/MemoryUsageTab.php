<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 11:08 PM
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatus;
use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Template\Context as BackendTemplateContext;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class MemoryUsageTab
 */
class MemoryUsageTab extends BackendTemplate implements TabWidgetInterface
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Glushko_OpcacheManagement::management/index/tab/memory_usage_tab.phtml';

    /**
     * @var GetOpcacheStatus
     */
    protected $getOpcacheStatus;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheStatus $getOpcacheStatus
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheStatus $getOpcacheStatus,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->getOpcacheStatus = $getOpcacheStatus;
    }

    /**
     * @inheritdoc
     */
    public function getTabLabel()
    {
        return __('Memory Usage');
    }

    /**
     * @inheritdoc
     */
    public function getTabTitle()
    {
        return __('Memory Usage');
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

    /**
     * @return array
     */
    public function getMemoryUsage()
    {
        return $this->getOpcacheStatus->getMemoryUsage();
    }
}