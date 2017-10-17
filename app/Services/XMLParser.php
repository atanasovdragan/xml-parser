<?php
namespace App\Services;

class XMLParser {

    /**
     * Parse XML file
     * @param $file
     * @return \SimpleXMLElement
     */
    public function parseFile(string $file): \SimpleXMLElement 
    {
        return simplexml_load_file($file);
    }

}