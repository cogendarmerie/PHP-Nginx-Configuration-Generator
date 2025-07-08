<?php

namespace Cogendar38\PhpNginxConfigGenerator;


use Cogendar38\PhpNginxConfigGenerator\Collection\LocationCollection;
use Cogendar38\PhpNginxConfigGenerator\Interface\LocationBlockInterface;

class NginxConfigGenerator
{
    public function __construct(
        private string $serverName,
        private string $rootDirectory,
        private LocationCollection $locations = new LocationCollection()
    )
    {
    }

    public function getServerName(): string
    {
        return $this->serverName;
    }

    public function getRootDirectory(): string
    {
        return $this->rootDirectory;
    }

    public function getLocations(): LocationCollection
    {
        return $this->locations;
    }

    public function addLocation(LocationBlockInterface $location): void
    {
        $this->locations->add($location);
    }

    public function render(): string
    {
        $file = file_get_contents(__DIR__ . "/example.conf");

        $file = str_replace('%server_name%', $this->serverName, $file);
        return str_replace('%locations%', $this->locations->render(), $file);
    }
}