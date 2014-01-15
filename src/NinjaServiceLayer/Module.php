<?php
/**
 * Module
 *
 * This is the module class for the NinjaServiceLayer module.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer
 */

namespace NinjaServiceLayer;

/**
 * Module
 *
 * This is the module class for the NinjaServiceLayer module.
 *
 * @author Daniel Del Rio <ddelrio1986@gmail.com>
 * @package NinjaServiceLayer
 */
class Module
{

    /**
     * Get Autoloader Config
     *
     * Get the autoloader configuration for this module.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return array The autoloader configuration for this module.
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * Get Config
     *
     * Get the configuration for this module.
     *
     * @author Daniel Del Rio <ddelrio1986@gmail.com>
     * @return array The configuration for this module.
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
