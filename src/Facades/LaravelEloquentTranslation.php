<?php

namespace Urusaich\LaravelEloquentTranslation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Urusaich\LaravelEloquentTranslation\LaravelEloquentTranslation
 */
class LaravelEloquentTranslation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Urusaich\LaravelEloquentTranslation\LaravelEloquentTranslation::class;
    }
}
