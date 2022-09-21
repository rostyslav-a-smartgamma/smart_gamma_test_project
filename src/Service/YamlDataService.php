<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class YamlDataService
{
    private string $dataFileDir;

    public function __construct(string $dataFileDir) {

        $this->dataFileDir = $dataFileDir;
    }

    public function getData(): array
    {
        return Yaml::parseFile($this->dataFileDir);
    }

}