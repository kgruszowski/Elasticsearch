<?php

namespace AppBundle\Command;

use AppBundle\Utils\Iterator\XMLIterator;
use AppBundle\Utils\Parser\ParserFactory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SyncProductsCommand extends ContainerAwareCommand
{

    public function configure()
    {
        $this
            ->setName('elastic:sync:products')
            ->setDescription('Command synchronizing product names with elasticsearch index')
            ->addOption('filename', 'f', InputOption::VALUE_REQUIRED, 'Name of parsed file')
            ->addOption('parserName', 'p', InputOption::VALUE_REQUIRED, 'Name of parser to use');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getOption('filename');
        $parserName = $input->getOption('parserName');

        $filePath = $this->getFilepath($filename);
        $elasticsearchSynchronizer = $this->getContainer()->get("elasticsearch.synchronizer");

        $parser = ParserFactory::create($parserName);
        $feedIterator = new XMLIterator($filePath, $parser->getMainNodeName());
        $feedParser = $this->getContainer()->get("feed.parser");
        $feedParser->setParser($parser);

        $output->writeln(sprintf("Start synchronizing %s", $parserName));
        $i = 0;
        foreach ($feedIterator as $row) {
            $feedParser->addToData($row);
            $i++;

            if ($feedParser->readyToSync()) {
                $data = $feedParser->getData();
                $elasticsearchSynchronizer->sync($data);
            }
        }

        if ($data = $feedParser->getData()) {
            $elasticsearchSynchronizer->sync($data);
        }

        $output->writeln(sprintf("Synchornized %d products", $i));
        return 1;
    }

    private function getFilePath(string $filename): string
    {
        $appPath = $this->getContainer()->getParameter("kernel.root_dir");
        return sprintf("%s/../src/AppBundle/Resources/xml/%s", $appPath, $filename);
    }
}
