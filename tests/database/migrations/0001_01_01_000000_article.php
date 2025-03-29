<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Urusaich\LaravelEloquentTranslation\Tests\app\Models\Article;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $blueprint) {
            $blueprint->id();
        });

        Schema::create('articles_translations', function (Blueprint $blueprint) {
            $blueprint->translation(new Article());
            $blueprint->string('text');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles_translations');
        Schema::dropIfExists('articles');
    }
};