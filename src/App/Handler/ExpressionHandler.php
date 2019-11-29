<?php

/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace App\Handler;

use App\Expressions\Language;
use RuntimeException;
use Zend\Http\PhpEnvironment\Request;
use Symfony\Component\ExpressionLanguage\SyntaxError;
use Zend\Diactoros\Response\JsonResponse;

class ExpressionHandler
{

    public function __invoke(): JsonResponse
    {
        $request = new Request();
        $params = json_decode($request->getContent(), false);
        if (empty($params->expression)) {
            throw new RuntimeException('Field expression is mandatory.');
        }
        try {
            $result = Language::resolve($params->expression);
            return new JsonResponse(['result' => $result, 'valid' => true, 'error' => null]);
        } catch (SyntaxError $e) {
            return new JsonResponse(['result' => null, 'valid' => false, 'error' => $e->getMessage()]);
        }
    }
}
