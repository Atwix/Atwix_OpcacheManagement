<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information\CachedScripts;

use Glushko\OpcacheManagement\Service\Opcache\Information\GetOpcacheStatus;
use Magento\Framework\Data\Collection as DataCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
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
     * @param bool $printQuery
     * @param bool $logQuery
     *
     * @return $this
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $cachedScripts = $this->prepareCachedScripts($this->getOpcacheStatus->getCachedScripts());

        foreach ($cachedScripts as $cachedScriptInformation) {
            $this->addItem($this->map($cachedScriptInformation));
        }

        $this->_setIsLoaded(true);
    }

    /**
     * @param array $cachedScriptInformation
     *
     * @return \Magento\Framework\DataObject
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
        return 'Hits: ' . $cachedScriptInformation['hits'];
    }

    /**
     * @param array $allCachedScripts
     *
     * @return array
     */
    protected function prepareCachedScripts($allCachedScripts)
    {
        $scriptCollection = array_values($allCachedScripts);

        // apply filters


        // apply paging
        //$scriptCollection = array_slice($allCachedScripts, $this->getCurPage(), $this->getPageSize());
        //var_dump($scriptCollection);

        return $scriptCollection;
    }
}