<?php

namespace App\Worldofmusic;

use JMS\Serializer\Annotation as Serializer;


/**
 * @Serializer\XmlRoot("record")
 *
 */
final class Record
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $title;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $genre;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $releasedate;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $label;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $formats;

    /**
     * @Serializer\Type("App\Worldofmusic\TrackListing")
     */
    private $tracklisting;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    /**
     * @return \DateTime|null
     * @throws \Exception
     */
    public function getReleasedate(): ?\DateTime
    {
        return new \DateTime(date('Y-m-d', strtotime($this->releasedate)));
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string|null
     */
    public function getFormats(): ?string
    {
        return $this->formats;
    }

    /**
     * @return TrackListing|null
     */
    public function getTracklisting(): ?TrackListing
    {
        return $this->tracklisting;
    }

}
