<?php

namespace App\Interfaces;

/**
 * Interface SerializerDeserializeInterface
 * @package Interfaces
 */
interface SerializerDeserializeInterface {

    public function deserialize(string $data, $objectClass);

    public function serialize($data);
}
