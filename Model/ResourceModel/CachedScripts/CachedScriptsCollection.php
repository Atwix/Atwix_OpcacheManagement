<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Model\ResourceModel\CachedScripts;

use Atwix\OpcacheManagement\Service\Opcache\Information\GetCachedScriptsService;
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
     * @var DataObjectFactory
     */
    protected $dataObjectFactory;

    /**
     * @var GetCachedScriptsService
     */
    protected $getCachedScriptsService;

    /**
     * CachedScriptsCollection constructor.
     * @param EntityFactoryInterface $entityFactory
     * @param GetCachedScriptsService $getCachedScriptsService
     * @param DataObjectFactory $dataObjectFactory
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        GetCachedScriptsService $getCachedScriptsService,
        DataObjectFactory $dataObjectFactory
    ) {
        parent::__construct($entityFactory);

        $this->dataObjectFactory = $dataObjectFactory;
        $this->getCachedScriptsService = $getCachedScriptsService;
    }

    /**
     * @inheritdoc
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $allCachedScripts = $this->getCachedScriptsService->execute();

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