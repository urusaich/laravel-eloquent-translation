<?php

namespace Urusaich\LaravelEloquentTranslation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelEloquentTranslationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-eloquent-translation');
    }

    public function register(): void
    {
        parent::register();

        Blueprint::macro('translation', function (Model|string $model) {
            /**
             * @var Blueprint $this
             */
            if (is_string($model)) {
                $model = new $model;
            }

            $this->string('locale')->unique();
            $this->foreignId($model->getKeyName())
                ->constrained($model->getTable(), $model->getKeyName());
        });
    }
}
