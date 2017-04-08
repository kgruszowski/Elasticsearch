<?php

namespace AppBundle\Command;

use AppBundle\Utils\Iterator\XMLIterator;
use AppBundle\Utils\Parser\ModanisaParser;
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
        $feedIterator = new XMLIterator($xmlPath, ModanisaParser::MAIN_NODE_NAME);
        $feedParser = $this->getContainer()->get("feed.parser");
        $feedParser->setParser(new ModanisaParser());

        foreach ($feedIterator as $row) {
            $feedParser->addToData($row);

            if ($feedParser->readyToSync()) {
                $data = $feedParser->getData();
                dump($data);die;
            }
        }
    }
}
