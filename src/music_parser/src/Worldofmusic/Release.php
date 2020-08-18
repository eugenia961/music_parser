<?php

namespace App\Worldofmusic;

use JMS\Serializer\Annotation as Serializer;

/**
 * Entity Release
 * @Serializer\XmlRoot("release")
 *
 */
final class Release
{

    /**
     *
     * @var string
     * @Serializer\Type("string")
     */
    private $name;

    /**
     *
     * @var int
     * @Serializer\Type("int")
     *
     *
     */
    private $trackCount;

    /**
     *
     * @param string $name
     * @param int $trackCount
     */
    public function __construct($name, $trackCount)
    {
        $this->name = $name;
        $this->trackCount = $trackCount;
    }

    /**
     * @param $name
     * @param $trackCount
     * @return Release
     */
    public static function created($name, $trackCount): Release
    {

        return new self($name, (int)$trackCount);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getTrackCount(): ?int
    {
        return $this->trackCount;
    }

}
