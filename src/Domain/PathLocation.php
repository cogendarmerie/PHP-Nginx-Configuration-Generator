<?php

namespace Cogendar38\PhpNginxConfigGenerator\Domain;

use Cogendar38\PhpNginxConfigGenerator\Interface\LocationBlockInterface;

class PathLocation implements LocationBlockInterface
{
    public function __construct(
        private string $path
    )
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function render(): string
    {
        return <<<NGINX
        location {$this->path} {
                try_files \$uri /index.php\$is_args\$args;
            }
        NGINX;
    }
}