<?php

namespace App\Utils;

use App\Interfaces\SerializerDeserializeInterface;
use JMS\Serializer\SerializerInterface;

/**
 * Class XmlSerializerDeserialize
 * @package Utils
 */
final class XmlSerializerDeserialize implements SerializerDeserializeInterface {
    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * XmlSerializerDeserialize constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }

    /**
     * @param string $data
     * @param $objectClass
     * @return mixed
     */
    public function deserialize(string $data, $objectClass)
    {

        return $this->serializer->deserialize($data, $objectClass, "xml");
    }

    /**
     * @param $data
     * @return string
     */
    public function serialize($data)
    {
        return $this->serializer->serialize($data, "xml");
    }

}
