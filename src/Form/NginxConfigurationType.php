<?php

namespace Cogendar38\PhpNginxConfigGenerator\Form;

use Cogendar38\PhpNginxConfigGenerator\DataMapper\NginxConfigurationDataMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class NginxConfigurationType extends AbstractType
{
    public function getBlockPrefix()
    {
        return '';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('server_name', TextType::class, [
                'label' => 'Nom du serveur',
                'required' => true,
            ])
            ->add('php_version', TextType::class, [
                'label' => 'Version de PHP',
                'required' => false,
                'empty_data' => '8.3'
            ])
            ->add('root_directory', TextType::class, [
                'label' => 'Répertoire racine',
                'required' => false,
                'empty_data' => '/var/www/html'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Générer'
            ])
        ;
        $builder->setMethod("GET");
        $builder->setDataMapper(new NginxConfigurationDataMapper());
    }
}