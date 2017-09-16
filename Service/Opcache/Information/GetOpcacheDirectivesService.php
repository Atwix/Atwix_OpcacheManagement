<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;

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