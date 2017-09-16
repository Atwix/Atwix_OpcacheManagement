<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatisticsData;
use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatisticsService;
use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Template\Context as BackendTemplateContext;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class StatisticsTab
 */
class StatisticsTab extends BackendTemplate implements TabWidgetInterface
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Glushko_OpcacheManagement::management/index/tab/statistics_tab.phtml';

    /**
     * @var GetOpcacheStatisticsService
     */
    protected $getOpcacheStatisticsService;

    /**
     * @var OpcacheStatisticsData
     */
    protected $opcacheStatisticsData;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheStatisticsService $getOpcacheStatisticsService
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheStatisticsService $getOpcacheStatisticsService,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getOpcacheStatisticsService = $getOpcacheStatisticsService;
    }

    /**
     * @inheritdoc
     */
    public function getTabLabel()
    {
        return __('Statistics');
    }

    /**
     * @inheritdoc
     */
    public function getTabTitle()
    {
        return __('Statistics');
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
     * @return OpcacheStatisticsData
     */
    public function getOpcacheStatisticsData()
    {
        if (NULL === $this->opcacheStatisticsData) {
            $this->opcacheStatisticsData = $this->getOpcacheStatisticsService->execute();
        }

        return $this->opcacheStatisticsData;
    }

    /**
     * @return int
     */
    public function getHits()
    {
        return $this->getOpcacheStatisticsData()->getHits();
    }

    /**
     * @return int
     */
    public function getOomRestarts()
    {
        return $this->getOpcacheStatisticsData()->getOomRestarts();
    }

    /**
     * @return int
     */
    public function getManualRestarts()
    {
        return $this->getOpcacheStatisticsData()->getManualRestarts();
    }

    /**
     * @return int
     */
    public function getMaxCachedKeys()
    {
        return $this->getOpcacheStatisticsData()->getMaxCachedKeys();
    }

    /**
     * @return int
     */
    public function getNumberCachedKeys()
    {
        return $this->getOpcacheStatisticsData()->getNumberCachedKeys();
    }

    /**
     * @return int
     */
    public function getNumberCachedScripts()
    {
        return $this->getOpcacheStatisticsData()->getNumberCachedScripts();
    }
}