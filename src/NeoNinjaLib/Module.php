<?php

namespace NinjaDoctrine2ServiceLayer;

use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;

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
                'DomainServiceLoader' => 'NinjaDoctrine2ServiceLayer\ServiceManager\DomainServiceLoaderFactory',
            ),
        );
    }
}