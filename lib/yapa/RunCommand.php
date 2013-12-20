<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:18
 */

namespace yapa;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command {

    protected function configure() {
        $this->setName('search')
            ->setAliases(array('s'))
            ->addOption("jobs", "j", InputOption::VALUE_REQUIRED, "jobs count", 4);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $jobControl = new JobControl((int)$input->getOption("jobs"));
        while($jobControl->isRun());
    }


} 