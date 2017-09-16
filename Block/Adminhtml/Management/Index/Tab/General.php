<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use DateTime;
use Glushko\OpcacheManagement\Data\Opcache\OpcacheStatisticsData;
use Glushko\OpcacheManagement\Factory\DateTimeFactory;
use Glushko\OpcacheManagement\Service\Format\SinceTimeFormatter;
use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatisticsService;
use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheVersionService;
use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Template\Context as BackendTemplateContext;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class General
 */
class General extends BackendTemplate implements TabWidgetInterface
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Glushko_OpcacheManagement::management/index/tab/general.phtml';

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