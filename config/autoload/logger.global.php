<?php
/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

use Psr\Log\LoggerInterface;
use rollun\logger\Formatter\ContextToString;
use rollun\logger\Processor\ExceptionBacktrace;
use rollun\logger\Processor\IdMaker;
use Zend\Log\Writer\Db as DbWriter;

return [
    'log' => [
        LoggerInterface::class => [
            'processors' => [
                [
                    'name' => IdMaker::class,
                ],
                [
                    'name' => ExceptionBacktrace::class,
                ],
            ],
            'writers' => [
                [
                    'name' => DbWriter::class,
                    'options' => [
                        'db' => 'db',
                        'table' => 'logs',
                        'column' => [
                            'id' => 'id',
                            'timestamp' => 'timestamp',
                            'message' => 'message',
                            'level' => 'level',
                            'priority' => 'priority',
                            'context' => 'context',
                            'lifecycle_token' => 'lifecycle_token',
                        ],
                        'formatter' => ContextToString::class,
                    ],
                ],
            ],
        ],
    ],
];