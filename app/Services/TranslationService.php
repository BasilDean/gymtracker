<?php

namespace App\Services;

class TranslationService
{
    public function transform($model, $attribute, $key = 'locale_title')
    {
        $model[$key] = $model->getTranslation($attribute, app()->getLocale());
        return $model;
    }
}
