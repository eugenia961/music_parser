<?php

namespace App\Worldofmusic;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class TrackListing
 * @package Worldofmusic
 */
final class TrackListing
{
    /**
     *
     * @Serializer\Type("ArrayCollection<string>")
     * @Serializer\XmlList(inline=true, entry="track")
     */
    private $tracks;

    /**
     *
     */
    public function __construct()
    {
        $this->tracks = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|null
     */
    public function getTracks(): ?ArrayCollection
    {
        return new ArrayCollection($this->tracks->toArray());
    }

}
