<?php

namespace Urusaich\LaravelEloquentTranslation\Commands;

use Illuminate\Console\Command;

class LaravelEloquentTranslationCommand extends Command
{
    public $signature = 'laravel-eloquent-translation';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
