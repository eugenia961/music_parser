<?php

namespace App\Tests;

use App\Worldofmusic\Record;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;
use App\Worldofmusic\Records;
use App\Repository\MatchingReleasesRepository;

/**
 * Class RecordTest
 * @package App\Tests
 */
class RecordTest extends TestCase
{
    /**
     * @var string
     */
    private $filename;

    protected function setUp(): void
    {
        $this->filename = dirname(__DIR__, 1) . "/public/worldofmusicTest.xml";
    }

    /**
     *
     */
    public function testXmlParse()
    {
        $content = \file_get_contents($this->filename);
        $serializer = SerializerBuilder::create()->build();
        $records = $serializer->deserialize($content, Records::class, 'xml');

        $this->assertCount(3, $records->getRecords());
        $this->assertEquals($records->getRecords()->get(1)->getTitle(),
            "Century Media 10th Anniversary Box Set Collection - Disk 1");
        $this->assertCount(18, $records->getRecords()->get(1)->getTracklisting()->getTracks());
        $this->assertCount(0, $records->getRecords()->get(2)->getTracklisting()->getTracks());
        /**
         * @var Record $record
         */
        $record = $records->getRecords()->get(0);

        $this->assertEquals($record->getReleasedate()->format("Y.m.d"), "1997.08.18");
    }

    /**
     * @throws \Exception
     */
    public function testFilter()
    {

        $content = \file_get_contents($this->filename);
        $serializer = SerializerBuilder::create()->build();
        $records = $serializer->deserialize($content, Records::class, 'xml');
        $matchingReleasesRepository = new MatchingReleasesRepository();
        $filters = ['date' => "1997-08-18", 'count' => 10];
        $releases = $matchingReleasesRepository->storeRecords($records, $filters);
        $this->assertCount(1, $releases->getReleases());
    }

}
