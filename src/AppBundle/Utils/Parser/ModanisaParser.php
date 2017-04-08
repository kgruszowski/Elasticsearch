<?php

namespace AppBundle\Utils\Parser;

class ModanisaParser implements ProductParser
{
    const MAIN_NODE_NAME = "urun";

    protected $row;

    public function setRow(\SimpleXMLElement $row)
    {
        $this->row = $row;
    }

    public function getTitle()
    {
        if ($this->row) {
            return (string)$this->row->baslik;
        }

        return null;
    }

}