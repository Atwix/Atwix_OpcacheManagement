<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Model\ResourceModel\CachedScripts;

use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatus;
use Magento\Framework\Data\Collection as DataCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;

/**
 * Class CachedScriptsCollection
 */
class CachedScriptsCollection extends DataCollection
{
    /**
     * @var GetOpcacheStatus
     */
    protected $getOpcacheStatus;

    /**
     * @var DataObjectFactory
     */
    protected $dataObjectFactory;

    /**
     * CachedScriptsCollection constructor.
     * @param EntityFactoryInterface $entityFactory
     * @param GetOpcacheStatus $getOpcacheStatus
     * @param DataObjectFactory $dataObjectFactory
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        GetOpcacheStatus $getOpcacheStatus,
        DataObjectFactory $dataObjectFactory
    ) {
        parent::__construct($entityFactory);

        $this->getOpcacheStatus = $getOpcacheStatus;
        $this->dataObjectFactory = $dataObjectFactory;
    }

    /**
     * @inheritdoc
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $allCachedScripts = $this->getOpcacheStatus->getCachedScripts();

        $this->_totalRecords = count($allCachedScripts);
        $this->_setIsLoaded();

        $pagedCachedScripts = $this->applyPagination($allCachedScripts);

        foreach ($pagedCachedScripts as $cachedScriptInformation) {
            $this->addItem($this->map($cachedScriptInformation));
        }

        return $this;
    }

    /**
     * @param array $cachedScriptInformation
     *
     * @return DataObject
     */
    protected function map($cachedScriptInformation)
    {
        return $this->dataObjectFactory->create([
            'data' => [
                'script_path' => $cachedScriptInformation['full_path'],
                'information' => $this->prepareCachedScriptInformation($cachedScriptInformation),
            ]
        ]);
    }

    /**
     * @param array $cachedScriptInformation
     *
     * @return string
     */
    protected function prepareCachedScriptInformation($cachedScriptInformation)
    {
        return __('Hits: %1', $cachedScriptInformation['hits']);
    }

    /**
     * @param array $allCachedScripts
     *
     * @return array
     */
    protected function applyPagination($allCachedScripts)
    {
        $currentPage = $this->getCurPage();
        $pageSize = $this->getPageSize();

        // apply paging
        $scriptCollection = array_slice($allCachedScripts, $currentPage, $pageSize);

        return $scriptCollection;
    }
}