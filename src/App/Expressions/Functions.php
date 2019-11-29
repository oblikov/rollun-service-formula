<?php

declare(strict_types=1);

namespace App\Expressions;

use rollun\callback\Callback\SerializedCallback;

class Functions
{
    public static function getAll(): array
    {
        return [
            'ping' => new SerializedCallback(static function () {
                return 'pong';
            }),
            'concat' => new SerializedCallback(static function ($a, $b) {
                return $a . $b;
            })
        ];
    }

}
