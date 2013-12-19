<?php
/**
 * User: inpu
 * Date: 20.12.13
 * Time: 1:18
 */

namespace yapa;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command {

    protected function configure() {
        $this->setName('search')
            ->setAliases(array('s'))
            ->addArgument("query", InputArgument::REQUIRED, "search string")
            ->addOption("jobs", "j", InputOption::VALUE_REQUIRED, "jobs count", 4)
            ->addOption("page-size", "p", InputOption::VALUE_REQUIRED,
                "results per page", 10);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("Start jobs");
        $jobControl = new JobControl($input->getOption("jobs"));
        $jobControl->setQuery($input->getArgument("query"));
        $jobControl->setResultsPerPage($input->getOption("page-size"));
        while($jobControl->isRun()) {

        }
    }


} 