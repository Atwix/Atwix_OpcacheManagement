<?php
/**
 * @author Atwix
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_OpcacheManagement
 */

namespace Atwix\OpcacheManagement\Service\Opcache\Information;

use Atwix\OpcacheManagement\Lib\OpcacheLibInterface;

/**
 * Class GetOpcacheDirectivesService
 */
class GetOpcacheDirectivesService
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcacheWrapper;

    /**
     * GetOpcacheDirectivesService constructor.
     *
     * @param OpcacheLibInterface $opcacheWrapper
     */
    public function __construct(OpcacheLibInterface $opcacheWrapper)
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