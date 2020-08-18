<?php

namespace App\Interfaces;

/**
 * Interface PrintMatchingReleasesInterface
 * @package Interfaces
 */
interface PrintMatchingReleasesInterface
{
    /**
     * @param $data
     * @return string
     */
    public function printMatchingReleases($data): string;
}
