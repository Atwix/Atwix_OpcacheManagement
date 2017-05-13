<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/13/17
 * Time: 9:27 AM
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