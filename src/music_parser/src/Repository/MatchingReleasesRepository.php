<?php

namespace App\Repository;


use App\Interfaces\ReleasesRepository;
use App\Worldofmusic\MatchingReleases;
use App\Worldofmusic\Record;
use App\Worldofmusic\Release;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class MatchingReleasesRepository
 * @package App\Repository
 */
final class MatchingReleasesRepository extends ArrayCollection implements ReleasesRepository
{

    /**
     * @param $records
     * @param $filters
     * @return MatchingReleases
     * @throws \Exception
     */
    public function storeRecords($records, $filters): MatchingReleases
    {

        foreach ($records->getRecords()->getIterator() as $record) {

            if ($this->validateRecordByDateandTrackCount($record, $filters)) {
                $release = Release::created($record->getName(), $record->getTracklisting()->getTracks()->count());
                $this->add($release);
            }
        }

        return MatchingReleases::created($this);
    }

    /**
     * @param Record $record
     * @param array $filters
     * @return bool
     * @throws \Exception
     */
    private function validateRecordByDateandTrackCount(Record $record, array $filters): bool
    {
        $date = new \DateTime($filters['date']);
        $count = $filters['count'];
        $trackCount = $record->getTracklisting()->getTracks()->count();
        return ($date > $record->getReleasedate()) && ($count < $trackCount);
    }

}
