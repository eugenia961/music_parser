<?php

namespace App\Utils;

use App\Interfaces\PrintMatchingReleasesInterface;

/**
 * Class PrintXMLFileMatchingReleases
 * @package Utils
 */
class PrintXMLFileMatchingReleases implements PrintMatchingReleasesInterface
{
    /**
     * @param $data
     * @return string
     */
    public function printMatchingReleases($data): string
    {
        $date = \date("YmdHiss");
        $filename = dirname(__DIR__, 2) . "/public/worldofmusicrelease" . $date . ".xml";
        \file_put_contents($filename, $data);
        return $filename;
    }

}
