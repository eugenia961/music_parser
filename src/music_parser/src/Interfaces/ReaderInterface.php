<?php

namespace App\Interfaces;

/**
 * Interface ReaderInterface
 * @package Interfaces
 */
interface ReaderInterface
{
    /**
     * @param string $filename
     * @return string
     */
    public function read(string $filename): string;
}
