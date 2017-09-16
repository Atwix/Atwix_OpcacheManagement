<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Block\Adminhtml\Management\Index\Tab;

use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheDirectivesService;
use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Template\Context as BackendTemplateContext;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class DirectivesTab
 */
class DirectivesTab extends BackendTemplate implements TabWidgetInterface
{
    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Glushko_OpcacheManagement::management/index/tab/directives_tab.phtml';

    /**
     * @var GetOpcacheDirectivesService
     */
    protected $getOpcacheDirectivesService;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param GetOpcacheDirectivesService $getOpcacheDirectivesService
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        GetOpcacheDirectivesService $getOpcacheDirectivesService,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getOpcacheDirectivesService = $getOpcacheDirectivesService;
    }

    /**
     * @inheritdoc
     */
    public function getTabLabel()
    {
        return __('Directives');
    }

    /**
     * @inheritdoc
     */
    public function getTabTitle()
    {
        return __('Directives');
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
    public function getDirectives()
    {
        return $this->getOpcacheDirectivesService->execute();
    }
}