<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncProductNameCommand extends Command
{

    public function configure()
    {
        $this
            ->setName('elastic:sync:titles')
            ->setDescription('Command synchronizing product names with elasticsearch index');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "test";
    }
}
