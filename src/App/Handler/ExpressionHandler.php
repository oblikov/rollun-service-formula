<?php

/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class ExpressionHandler
{

    public function __invoke()
    {
        //$param = '1 + 2 - (1 - 2 - * 1.2 + (1))  1 ? 3 : 4';
        $param = '1 + 2';
        $result = false;
        try {
            $expression = new ExpressionLanguage();
            $result = $expression->evaluate($param);
            return new JsonResponse(['valid' => $result]);

        } catch (SyntaxError $e) {
            return new JsonResponse([
                'valid' => $result,
                'error' => $e->getMessage()
            ]);
        }

    }
}

