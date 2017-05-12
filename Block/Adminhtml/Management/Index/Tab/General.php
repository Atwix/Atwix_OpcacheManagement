<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 11:08 PM
 */

namespace Glushko\OpCacheManagement\Block\Adminhtml\Management\Index\Tab;

use Glushko\OpCacheManagement\Lib\OpCacheInterface;
use Magento\Backend\Block\Template as BackendTemplate;
use Magento\Backend\Block\Template\Context as BackendTemplateContext;
use Magento\Backend\Block\Widget\Tab\TabInterface as TabWidgetInterface;

/**
 * Class General
 */
class General extends BackendTemplate implements TabWidgetInterface
{
    /**
     * @var OpCacheInterface
     */
    protected $opCacheWrapper;

    /**
     * General constructor.
     *
     * @param BackendTemplateContext $context
     * @param OpCacheInterface $opCacheWrapper
     * @param array $data
     */
    public function __construct(
        BackendTemplateContext $context,
        OpCacheInterface $opCacheWrapper,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->opCacheWrapper = $opCacheWrapper;
    }

    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'Glushko_OpCacheManagement::management/index/tab/general.phtml';

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

    public function getConfiguration()
    {
        return $this->opCacheWrapper->getConfiguration();
    }
}