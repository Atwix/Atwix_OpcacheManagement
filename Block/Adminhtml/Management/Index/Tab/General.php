<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use DateTime;
use Glushko\OpcacheManagement\Factory\DateTimeFactory;
use Glushko\OpcacheManagement\Service\Format\SinceTimeFormatter;
use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatus;
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
     * @var GetOpcacheVersionService
     */
    protected $getOpcacheVersion;

    /**
     * @var GetOpcacheStatus
     */
    protected $getOpcacheStatus;

    /**
     * @var SinceTimeFormatter
     */
    protected $sinceTimeFormatter;

    /**
     * @var DateTimeFactory
     */
    protected $dateTimeFactory;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheVersionService $getOpcacheVersion
     * @param GetOpcacheStatus $getOpcacheStatus
     * @param SinceTimeFormatter $sinceTimeFormatter
     * @param DateTimeFactory $dateTimeFactory
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheVersionService $getOpcacheVersion,
        GetOpcacheStatus $getOpcacheStatus,
        SinceTimeFormatter $sinceTimeFormatter,
        DateTimeFactory $dateTimeFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->getOpcacheVersion = $getOpcacheVersion;
        $this->getOpcacheStatus = $getOpcacheStatus;
        $this->sinceTimeFormatter = $sinceTimeFormatter;
        $this->dateTimeFactory = $dateTimeFactory;
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
        $opcacheVersionData = $this->getOpcacheVersion->execute();

        return $opcacheVersionData->getProductName() . ' ' . $opcacheVersionData->getVersion();
    }

    /**
     * @return string
     */
    public function getUptime()
    {
        $statistics = $this->getOpcacheStatus->getStatistics();
        /** @var DateTime $dateTime */
        $dateTime = $this->dateTimeFactory->create();

        return $this->sinceTimeFormatter->format(
            $dateTime->getTimestamp(),
            $statistics['start_time'],
            1,
            ''
        );
    }

    /**
     * @return string
     */
    public function getLastRestart()
    {
        $statistics = $this->getOpcacheStatus->getStatistics();
        /** @var DateTime $dateTime */
        $dateTime = $this->dateTimeFactory->create();

        return $this->sinceTimeFormatter->format($dateTime->getTimestamp(), $statistics['last_restart_time']);
    }
}