<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Atwix\OpcacheManagement\Data\Opcache\OpcacheMemoryUsageData;
use Atwix\OpcacheManagement\Service\Format\BytesFormatter;
use Atwix\OpcacheManagement\Service\Format\PercentageFormatter;
use Atwix\OpcacheManagement\Service\Opcache\Information\GetOpcacheMemoryUsageService;
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
    protected $_template = 'Atwix_OpcacheManagement::management/index/tab/memory_usage_tab.phtml';

    /**
     * @var OpcacheMemoryUsageData
     */
    protected $opcacheMemoryUsageData;

    /**
     * @var BytesFormatter
     */
    protected $bytesFormatter;

    /**
     * @var PercentageFormatter
     */
    protected $percentageFormatter;

    /**
     * @var GetOpcacheMemoryUsageService
     */
    protected $getOpcacheMemoryUsageService;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheMemoryUsageService $getOpcacheMemoryUsageService
     * @param BytesFormatter $bytesFormatter
     * @param PercentageFormatter $percentageFormatter
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheMemoryUsageService $getOpcacheMemoryUsageService,
        BytesFormatter $bytesFormatter,
        PercentageFormatter $percentageFormatter,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->bytesFormatter = $bytesFormatter;
        $this->percentageFormatter = $percentageFormatter;
        $this->getOpcacheMemoryUsageService = $getOpcacheMemoryUsageService;
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
     * @return OpcacheMemoryUsageData
     */
    public function getOpcacheMemoryUsageData()
    {
        if (NULL === $this->opcacheMemoryUsageData) {
            $this->opcacheMemoryUsageData = $this->getOpcacheMemoryUsageService->execute();
        }

        return $this->opcacheMemoryUsageData;
    }

    /**
     * @return string
     */
    public function getUsedMemory()
    {
        return $this->bytesFormatter->format(
            $this->getOpcacheMemoryUsageData()->getUsedMemory()
        );
    }

    /**
     * @return string
     */
    public function getFreeMemory()
    {
        return $this->bytesFormatter->format(
            $this->getOpcacheMemoryUsageData()->getFreeMemory()
        );
    }

    /**
     * @return string
     */
    public function getWastedMemory()
    {
        return $this->bytesFormatter->format(
            $this->getOpcacheMemoryUsageData()->getWastedMemory()
        );
    }

    /**
     * @return string
     */
    public function getCurrentWastedPercentage()
    {
        return $this->percentageFormatter->format(
            $this->getOpcacheMemoryUsageData()->getCurrentWastedPercentage()
        );
    }
}