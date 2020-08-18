<?php

namespace App\Worldofmusic;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Serializer\XmlRoot("records")
 */
final class Records
{

    /**
     * @Serializer\Type("ArrayCollection<App\Worldofmusic\Record>")
     * @Serializer\XmlList(inline=true, entry="record")
     */
    private $records;

    /**
     *
     */
    public function __construct()
    {
        $this->records = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|null
     */
    public function getRecords(): ?ArrayCollection
    {
        return new ArrayCollection($this->records->toArray());

    }

}
