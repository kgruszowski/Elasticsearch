<?php

namespace AppBundle\Service;

use AppBundle\Utils\Parser\ProductParser;

class FeedParser
{
    const SYNC_CHUNK = 1000;

    /** @var ProductParser */
    protected $parser;
    protected $data = [];

    public function setParser(ProductParser $parser)
    {
        $this->parser = $parser;
    }

    public function addToData(\SimpleXMLElement $row)
    {
        $this->parser->setRow($row);
        $this->data[] = $this->parser->getTitle();
    }

    public function getData() : array
    {
        $data = $this->data;
        $this->data = [];
        return $data;
    }

    public function readyToSync(): bool
    {
        return count($this->data) % self::SYNC_CHUNK == 0;
    }

}