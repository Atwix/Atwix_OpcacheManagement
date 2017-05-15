<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Service\Opcache\Information;

use Glushko\OpcacheManagement\Lib\OpcacheInterface;

/**
 * Class GetOpcacheConfiguration
 */
class GetOpcacheConfiguration
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
     * @return array
     */
    public function getDirectives()
    {
        $configuration = $this->opcacheWrapper->getConfiguration();

        return $configuration['directives'];
    }

    /**
     * @return array
     */
    public function getBlacklist()
    {
        $configuration = $this->opcacheWrapper->getConfiguration();

        return $configuration['blacklist'];
    }
}