<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class YamlDataService
{
    private string $dataFileDir;

    public function __construct(string $dataFileDir) {

        $this->dataFileDir = $dataFileDir;
    }

    public function readData(): array
    {
        return Yaml::parseFile($this->dataFileDir);
    }

    public function writeData(array $data): array
    {
        $yaml = Yaml::dump($data, 10, 4,Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
        file_put_contents($this->dataFileDir, $yaml);

        return Yaml::parseFile($this->dataFileDir);
    }

    public function getOrgByIndex(int $index): array
    {
        $originalData = Yaml::parseFile($this->dataFileDir);

        return $originalData['organizations'][$index];
    }

    public function createOrg(array $data): array
    {
        $originalData = Yaml::parseFile($this->dataFileDir);
        $originalData['organizations'][] = $data;
        $this->writeData($originalData);

        return Yaml::parseFile($this->dataFileDir);
    }

    public function updateOrgByIndex(int $index, array $data): array
    {
        $originalData = Yaml::parseFile($this->dataFileDir);
        $data['users'] = array_values($data['users']);
        $originalData['organizations'][$index] = $data;
        $this->writeData($originalData);

        return Yaml::parseFile($this->dataFileDir);
    }

    public function deleteOrgByIndex(int $index): array
    {
        $originalData = Yaml::parseFile($this->dataFileDir);
        unset($originalData['organizations'][$index]);
        $originalData['organizations'] = array_values($originalData['organizations']);
        $this->writeData($originalData);

        return Yaml::parseFile($this->dataFileDir);
    }
}