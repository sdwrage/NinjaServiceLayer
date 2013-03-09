<?php

namespace NeoNinjaLib;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DomainServiceLoader' => 'NeoNinjaLib\ServiceManager\DomainServiceLoaderFactory',
            ),
        );
    }
}
