<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class ValidRouteRule extends Rule
{
    public function passes($attribute, $value): bool
    {
        return app('router')->getRoutes()->hasNamedRoute($value);
    }

    public function message(): string
    {
        return 'The :attribute is not a valid route.';
    }
}
