<?php

namespace Cogendar38\PhpNginxConfigGenerator\Collection;

use Cogendar38\PhpNginxConfigGenerator\Interface\LocationBlockInterface;

class LocationCollection
{
    private array $locations = [];

    public function add(LocationBlockInterface $block): void
    {
        $this->locations[] = $block;
    }

    public function getLocations(): array
    {
        return $this->locations;
    }

    public function count(): int
    {
        return count($this->locations);
    }

    public function render(): string
    {
        $output = '';
        foreach ($this->locations as $index=>$location) {
            $output .= $location->render();

            if ($index < $this->count() - 1) {
                $output .= "\n\n";
            }
        }
        return $output;
    }
}