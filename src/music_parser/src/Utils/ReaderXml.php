<?php

namespace App\Utils;

use App\Interfaces\ReaderInterface;
use App\Utils\ValidationFileXml;

/**
 * Class ReaderXml
 * @package App\Utils
 */
class ReaderXml implements ReaderInterface
{

    /**
     * @param string $filename
     * @return string
     */
    public function read(string $filename): string
    {
        $filename = dirname(__DIR__, 2) . "/public/" . $filename;
        $validationFile = new ValidationFileXml($filename);
        $validationFile->validateFileOrFail();
        return \file_get_contents($filename);
    }

}
