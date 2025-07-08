<?php

namespace Cogendar38\PhpNginxConfigGenerator\Domain;

use Cogendar38\PhpNginxConfigGenerator\Interface\LocationBlockInterface;

class SnippetPhpLocation implements LocationBlockInterface
{
    public function __construct(
        private string $version
    )
    {
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function render(): string
    {
        return <<<NGINX
        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php{$this->version}-fpm.sock;
                include fastcgi_params;
            }
        NGINX;
    }
}