<?php

namespace App\Utils;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\Exception\CannotWriteFileException;
use Symfony\Component\HttpFoundation\File\Exception\IniSizeFileException;

/**
 * Class ValidationFileXml
 * @package App\Utils
 */
final class ValidationFileXml
{
    /**
     * @var string $filename
     */
    private $filename;

    /**
     * ValidationFileXml constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     *
     */
    public function validateFileOrFail(): void
    {
        $this->validateFileExists();
        $this->validateSizeOrFail();
        $this->validateXMlFileOrFail();
    }

    /**
     *
     * @throws NotFoundHttpException
     */
    private function validateFileExists(): void
    {
        if (!\file_exists($this->filename)) {
            throw new NotFoundHttpException("File not found");
        }
    }

    /**
     *
     * @throws IniSizeFileException
     */
    private function validateSizeOrFail(): void
    {

        if (filesize($this->filename) == 0) {
            throw new IniSizeFileException("File is empty");
        }
    }

    /**
     *
     * @throws CannotWriteFileException
     */
    private function validateXMlFileOrFail(): void
    {

        $doc = new \DOMDocument();
        if (@$doc->load($this->filename) === false) {
            throw new CannotWriteFileException("File not valid");
        }
    }

}
