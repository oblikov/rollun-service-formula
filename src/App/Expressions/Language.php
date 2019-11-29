<?php

declare(strict_types=1);

namespace App\Expressions;

use rollun\datahandler\Evaluator\ExpressionFunction\Callback;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Language
{

    /**
     * @param $formula
     * @return mixed
     */
    public static function resolve($formula)
    {
        $expressionLanguage = new ExpressionLanguage();
        foreach (Functions::getAll() as $name => $callback) {
            $expressionLanguage->addFunction(new Callback($callback, $name));
        }
        $expressionLanguage->registerProvider(Filters::getAll());
        return $expressionLanguage->evaluate($formula);
    }
}
