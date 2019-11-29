<?php

declare(strict_types=1);

namespace App\Expressions;

use rollun\callback\Callback\SerializedCallback;
use rollun\datahandler\Evaluator\ExpressionFunction\Providers\PluginExpressionFunctionProvider;
use Zend\Filter\FilterPluginManager;
use Zend\ServiceManager\ServiceManager;

class Filters
{
    public static function getAll(): PluginExpressionFunctionProvider
    {

        $pluginManager = new FilterPluginManager(new ServiceManager());
        $services = ['digits', 'stringTrim'];
        return new PluginExpressionFunctionProvider($pluginManager, $services, 'filter');
    }

}
