<?php
/**
 * @author Roman Glushko
 * @copyright Copyright (c) 2017 Roman Glushko (http://www.linkedin.com/in/glushko-roman/)
 * @package Glushko_OpcacheManagement
 */

namespace Glushko\OpcacheManagement\Console;

use Glushko\OpcacheManagement\Service\Opcache\Management\OpcacheManagement;
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ResetCacheCommand
 */
class ResetCacheCommand extends ConsoleCommand
{
    /**
     * @var OpcacheManagement
     */
    protected $opcacheManagement;

    /**
     * ResetCacheCommand constructor.
     *
     * @param null|string $name
     * @param OpcacheManagement $opcacheManagement
     */
    public function __construct(
        OpcacheManagement $opcacheManagement
    ) {
        parent::__construct();

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
        // todo: need to check if opcache.enable_cli == 1

        if ($this->opcacheManagement->resetCache()) {
            $output->writeln("<info>The Opcache storage has been flushed.</info>");
        } else {
            $output->writeln("<info>The Opcache storage could't be flushed.</info>");
        }
    }
}