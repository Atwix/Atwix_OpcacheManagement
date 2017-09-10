<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Glushko\OpcacheManagement\Service\Format\BytesFormatter;
use Glushko\OpcacheManagement\Service\Format\PercentageFormatter;
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
     * @var array
     */
    protected $memoryUsage = false;

    /**
     * @var BytesFormatter
     */
    protected $bytesFormatter;

    /**
     * @var PercentageFormatter
     */
    protected $percentageFormatter;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheStatus $getOpcacheStatus
     * @param BytesFormatter $bytesFormatter
     * @param PercentageFormatter $percentageFormatter
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheStatus $getOpcacheStatus,
        BytesFormatter $bytesFormatter,
        PercentageFormatter $percentageFormatter,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->getOpcacheStatus = $getOpcacheStatus;
        $this->bytesFormatter = $bytesFormatter;
        $this->percentageFormatter = $percentageFormatter;
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
        if (!$this->memoryUsage) {
            $this->memoryUsage = $this->getOpcacheStatus->getMemoryUsage();
        }

        return $this->memoryUsage;
    }

    /**
     * @return string
     */
    public function getUsedMemory()
    {
        return $this->bytesFormatter->format($this->getMemoryUsage()['used_memory']);
    }

    /**
     * @return string
     */
    public function getFreeMemory()
    {
        return $this->bytesFormatter->format($this->getMemoryUsage()['free_memory']);
    }

    /**
     * @return string
     */
    public function getWastedMemory()
    {
        return $this->bytesFormatter->format($this->getMemoryUsage()['wasted_memory']);
    }

    /**
     * @return string
     */
    public function getCurrentWastedPercentage()
    {
        return $this->percentageFormatter->format($this->getMemoryUsage()['current_wasted_percentage']);
    }
}