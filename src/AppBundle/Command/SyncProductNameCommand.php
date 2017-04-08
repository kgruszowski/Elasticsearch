<?php

namespace AppBundle\Command;

use AppBundle\Utils\Iterator\XMLIterator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncProductNameCommand extends ContainerAwareCommand
{

    public function configure()
    {
        $this
            ->setName('elastic:sync:titles')
            ->setDescription('Command synchronizing product names with elasticsearch index');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $appPath = $this->getContainer()->getParameter("kernel.root_dir");
        $xmlPath = $appPath."/../src/AppBundle/Resources/xml/modanisa.xml";
        $feedIterator = new XMLIterator($xmlPath, "urun");

        foreach ($feedIterator as $row) {

        }
    }
}
