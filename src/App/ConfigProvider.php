<?php
/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace App;

use rollun\callback\Middleware\CallablePluginManagerFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            CallablePluginManagerFactory::KEY_INTERRUPTERS => [
                'invokables' => [Handler\ExpressionHandler::class => Handler\ExpressionHandler::class],
                'aliases' => [
                    'formula' => Handler\ExpressionHandler::class,
                ]
            ]
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\HomePageHandler::class => Handler\HomePageHandler::class,
                Handler\ExpressionHandler::class => Handler\ExpressionHandler::class,
            ],
            'aliases' => [
                'formula' => Handler\ExpressionHandler::class,
            ]
        ];
    }
}
