<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheInterface;

/**
 * Class GetOpcacheDirectivesService
 */
class GetOpcacheDirectivesService
{
    /**
     * @var OpcacheInterface
     */
    protected $opcacheWrapper;

    /**
     * GetOpcacheVersion constructor.
     *
     * @param OpcacheInterface $opcacheWrapper
     */
    public function __construct(OpcacheInterface $opcacheWrapper)
    {
        $this->opcacheWrapper = $opcacheWrapper;
    }

    /**
     * Retrieves Opcache directives
     *
     * @return array
     */
    public function execute()
    {
        $configurationData = $this->opcacheWrapper->getConfiguration();

        return array_key_exists('directives', $configurationData) ? $configurationData['directives'] : [];
    }
}