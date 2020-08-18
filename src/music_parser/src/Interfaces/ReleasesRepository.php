<?php

namespace App\Interfaces;

/**
 * Interface ReleasesRepository
 * @package Interfaces
 */
interface ReleasesRepository {

    public function storeRecords($records,$filters);
}
