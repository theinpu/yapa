<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:18
 */

namespace yapa;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command {

    protected function configure() {
        $this->setName('query')
            ->setAliases(array('q'))
            ->addArgument("query string");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("Start jobs");
    }


} 