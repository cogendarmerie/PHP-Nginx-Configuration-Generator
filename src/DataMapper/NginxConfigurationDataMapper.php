<?php

namespace Cogendar38\PhpNginxConfigGenerator\DataMapper;

use Cogendar38\PhpNginxConfigGenerator\Domain\SnippetPhpLocation;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Cogendar38\PhpNginxConfigGenerator\NginxConfigGenerator;

class NginxConfigurationDataMapper implements DataMapperInterface
{

    /**
     * @inheritDoc
     */
    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
        if (!$viewData) {
            return;
        }

        if (!$viewData instanceof NginxConfigGenerator) {
            throw new UnexpectedTypeException($viewData, NginxConfigGenerator::class);
        }

        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        $forms['server_name']->setData($viewData->getServerName());
        $forms['root_directory']->setData($viewData->getRootDirectory());

        foreach ($viewData->getLocations() as $location) {
            if ($location instanceof SnippetPhpLocation) {
                $forms['php_version'] = $location->getVersion();
                break;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        $viewData = new NginxConfigGenerator(
            serverName: $forms['server_name']->getData(),
            rootDirectory: $forms['root_directory']->getData()
        );

        $viewData->addLocation(new SnippetPhpLocation(version: $forms['php_version']->getData()));
    }
}