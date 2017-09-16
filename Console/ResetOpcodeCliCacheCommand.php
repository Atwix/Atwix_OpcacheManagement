<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Console;

use Glushko\OpcacheManagement\Lib\OpcacheLibInterface;
use Glushko\OpcacheManagement\Service\Opcache\Management\OpcacheManagement;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ResetOpcodeCliCacheCommand
 */
class ResetOpcodeCliCacheCommand extends ConsoleCommand
{
    /**
     * @var OpcacheLibInterface
     */
    protected $opcache;

    /**
     * @var OpcacheManagement
     */
    protected $opcacheManagement;

    /**
     * ResetOpcodeCliCacheCommand constructor.
     *
     * @param OpcacheManagement $opcacheManagement
     * @param OpcacheLibInterface $opcache
     */
    public function __construct(
        OpcacheLibInterface $opcache,
        OpcacheManagement $opcacheManagement
    ) {
        parent::__construct();

        $this->opcache = $opcache;
        $this->opcacheManagement = $opcacheManagement;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('glushko_opcachemanagement:cache:reset');
        $this->setDescription('All cached CLI scripts will be reloaded and reparsed the next time they are hit.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->opcache->isCliEnabled()) {
            $output->writeln("<error>The Opcache for CLI is disable. Please enable it to use this command</error>");

            return;
        }

        if ($this->opcacheManagement->resetCache()) {
            $output->writeln("<info>The Opcache CLI storage has been flushed.</info>");
        } else {
            $output->writeln("<info>The Opcache CLI storage could't be flushed.</info>");
        }
    }
}