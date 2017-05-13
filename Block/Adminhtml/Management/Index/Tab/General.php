<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 11:08 PM
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatus;
use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheVersion;
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
     * @var GetOpcacheVersion
     */
    protected $getOpcacheVersion;

    /**
     * @var GetOpcacheStatus
     */
    protected $getOpcacheStatus;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheVersion $getOpcacheVersion
     * @param GetOpcacheStatus $getOpcacheStatus
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheVersion $getOpcacheVersion,
        GetOpcacheStatus $getOpcacheStatus,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->getOpcacheVersion = $getOpcacheVersion;
        $this->getOpcacheStatus = $getOpcacheStatus;
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
        return $this->getOpcacheVersion->getOpcacheProductName() . ' ' . $this->getOpcacheVersion->getOpcacheVersion();
    }

    /**
     * @return string
     */
    public function getUptime()
    {
        $statistics = $this->getOpcacheStatus->getStatistics();

        return $statistics['start_time'];
    }

    /**
     * @return string
     */
    public function getLastRestart()
    {
        $statistics = $this->getOpcacheStatus->getStatistics();

        return $statistics['last_restart_time'];
    }
}