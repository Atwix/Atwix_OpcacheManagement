<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Block\Adminhtml\Management\Index\Tab\CachedScripts\Grid;

use Magento\Backend\Block\Context as BackendBlockContext;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Encryption\UrlCoder;

/**
 * Class CachedScriptsActionRenderer
 */
class CachedScriptsActionRenderer extends AbstractRenderer
{
    /**
     * @var DataObjectFactory
     */
    protected $dataObjectFactory;

    /**
     * @var UrlCoder
     */
    protected $urlCoder;

    /**
     * CachedScriptsActionRenderer constructor.
     *
     * @param BackendBlockContext $context
     * @param DataObjectFactory $dataObjectFactory
     * @param UrlCoder $urlCoder
     * @param array $data
     */
    public function __construct(
        BackendBlockContext $context,
        DataObjectFactory $dataObjectFactory,
        UrlCoder $urlCoder,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->dataObjectFactory = $dataObjectFactory;
        $this->urlCoder = $urlCoder;
    }

    /**
     * Renders action list for cached scripts
     *
     * @param DataObject $row
     *
     * @return string
     */
    public function render(DataObject $row)
    {
        $actions = [];
        $scriptPath = $this->urlCoder->encode($row->getData('script_path'));

        $actions[] = [
            '@' => [
                'href' => $this->getUrl(
                    '*/*/invalidateCachedScript',
                    [
                        'script_path' => $scriptPath
                    ]
                ),
            ],
            '#' => __('Invalidate'),
        ];

        return $this->actionsToHtml($actions);
    }

    /**
     * @param array $actions
     *
     * @return string
     */
    protected function actionsToHtml(array $actions)
    {
        $html = [];
        /** @var DataObject $attributesObject */
        $attributesObject = $this->dataObjectFactory->create();

        foreach ($actions as $action) {
            $attributesObject->setData($action['@']);
            $html[] = '<a ' . $attributesObject->serialize() . '>' . $action['#'] . '</a>';
        }

        return implode('<span class="separator">&nbsp;|&nbsp;</span>', $html);
    }
}
