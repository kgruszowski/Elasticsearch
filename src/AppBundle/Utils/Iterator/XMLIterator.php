<?php

namespace AppBundle\Utils\Iterator;

/**
 * Class XMLIterator - iterator for efficient large xml file iterating
 * @package AppBundle\Utils\Iterator
 */
class XMLIterator implements \Iterator
{
    /** @var \XMLReader */
    protected $reader;

    protected $filePath;
    protected $mainNode;
    protected $key;
    protected $row;

    public function __construct(string $filePath, string $mainNode)
    {
        $this->filePath = $filePath;
        $this->mainNode = $mainNode;
    }

    public function current()
    {
        return $this->row;
    }

    public function next()
    {
        $this->row = null;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        if ($this->row === null) {
            $this->loadNext();
        }

        return $this->row !== null;
    }

    public function rewind()
    {
        $this->reader = new \XMLReader();
        $this->reader->open($this->filePath);
        $this->row = null;
        $this->key = null;
    }

    protected function loadNext()
    {
        if ($this->reader) {
            while ($this->reader->read()) {
                if ($this->reader->nodeType == \XMLReader::ELEMENT && $this->reader->name == $this->mainNode) {
                    try {
                        $this->row = new \SimpleXMLElement($this->reader->readOuterXML());
                    } catch (\Exception $ex) {
                        echo $ex->getMessage();
                    }
                    break;
                }
            }
        }
    }


}