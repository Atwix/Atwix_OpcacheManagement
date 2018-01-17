<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use DateTime;
use Atwix\OpcacheManagement\Data\Opcache\OpcacheStatisticsData;
use Atwix\OpcacheManagement\Factory\DateTimeFactory;
use Atwix\OpcacheManagement\Service\Format\SinceTimeFormatter;
use Atwix\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatisticsService;
use Atwix\OpcacheManagement\Service\Opcache\Information\GetOpcacheVersionService;
use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Template\Context as BackendTemplateContext;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class General
 */
class GeneralTab extends BackendTemplate implements TabWidgetInterface
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Atwix_OpcacheManagement::management/index/tab/general_tab.phtml';

    /**
     * @var DateTimeFactory
     */
    protected $dateTimeFactory;

    /**
     * @var SinceTimeFormatter
     */
    protected $sinceTimeFormatter;

    /**
     * @var OpcacheStatisticsData
     */
    protected $opcacheStatisticsData;

    /**
     * @var GetOpcacheStatisticsService
     */
    protected $getOpcacheStatisticsService;

    /**
     * @var GetOpcacheVersionService
     */
    protected $getOpcacheVersionService;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheVersionService $getOpcacheVersionService
     * @param GetOpcacheStatisticsService $getOpcacheStatisticsService
     * @param SinceTimeFormatter $sinceTimeFormatter
     * @param DateTimeFactory $dateTimeFactory
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheVersionService $getOpcacheVersionService,
        GetOpcacheStatisticsService $getOpcacheStatisticsService,
        SinceTimeFormatter $sinceTimeFormatter,
        DateTimeFactory $dateTimeFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->getOpcacheVersionService = $getOpcacheVersionService;
        $this->sinceTimeFormatter = $sinceTimeFormatter;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->getOpcacheStatisticsService = $getOpcacheStatisticsService;
    }

    /**
     * @inheritdoc
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * @inheritdoc
     */
    public function getTabTitle()
    {
        return __('General');
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
     * @return string
     */
    public function getOpcacheVersion()
    {
        $opcacheVersionData = $this->getOpcacheVersionService->execute();

        return $opcacheVersionData->getProductName() . ' ' . $opcacheVersionData->getVersion();
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
     * @return string
     */
    public function getUptime()
    {
        /** @var DateTime $dateTime */
        $dateTime = $this->dateTimeFactory->create();
        $startTime = $this->getOpcacheStatisticsData()->getStartTime();

        return $this->sinceTimeFormatter->format(
            $dateTime->getTimestamp(),
            $startTime,
            1,
            ''
        );
    }

    /**
     * @return string
     */
    public function getLastRestart()
    {
        /** @var DateTime $dateTime */
        $dateTime = $this->dateTimeFactory->create();
        $lastRestartTime = $this->getOpcacheStatisticsData()->getLastRestartTime();

        return $this->sinceTimeFormatter->format($dateTime->getTimestamp(), $lastRestartTime);
    }
}