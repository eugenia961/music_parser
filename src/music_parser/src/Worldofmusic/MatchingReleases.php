<?php

namespace App\Worldofmusic;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Serializer\XmlRoot("matchingReleases")
 */
class MatchingReleases
{

    /**
     *
     * @var type
     * @Serializer\Type("ArrayCollection<App\Worldofmusic\Release>")
     * @Serializer\XmlList(inline=true, entry="release")
     */
    private $releases;

    /**
     *
     * @param ArrayCollection $releases
     */
    public function __construct(ArrayCollection $releases)
    {
        $this->releases = $releases;
    }

    /**
     * @param ArrayCollection $releases
     * @return MatchingReleases
     */
    public static function created(ArrayCollection $releases): MatchingReleases
    {
        return new self($releases);
    }

    /**
     * @return ArrayCollection|null
     */
    public function getReleases(): ?ArrayCollection
    {
        return new ArrayCollection($this->releases->toArray());
    }

}
