<?php

namespace Urusaich\LaravelEloquentTranslation\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use JetBrains\PhpStorm\NoReturn;
use Orchestra\Testbench\TestCase as Orchestra;
use Urusaich\LaravelEloquentTranslation\LaravelEloquentTranslationServiceProvider;
use Urusaich\LaravelEloquentTranslation\Tests\app\Models\Article;
use Urusaich\LaravelEloquentTranslation\Tests\app\Models\ArticleTranslation;

class ExampleTest extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'Urusaich\\LaravelEloquentTranslation\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelEloquentTranslationServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        foreach (File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
        }
    }

    #[NoReturn] public function testTest(): void
    {
        $this->assertTrue(true);

        $article = new Article();
        $article->save();

        $this->assertDatabaseHas($article->getTable(), [
            $article->getKeyName() => $article->id,
        ]);
        $this->assertDatabaseMissing($article->getTranslationModel()->getTable(), [
            $article->getKeyName() => $article->id,
        ]);

        $this->assertFalse($article->translation('ru')->exists);
        $this->assertFalse($article->translation('en')->exists);
        $this->assertEmpty($article->translations);

        /** @var ArticleTranslation $ruTranslation */
        $ruTranslation = $article->translation('ru');

        $ruTranslation->text = 'ru text';
        $ruTranslation->save();

        $article->unsetRelations();

        $this->assertTrue($article->translation('ru')->exists);
        $this->assertFalse($article->translation('en')->exists);
        $this->assertCount(1, $article->translations);
        $this->assertEquals(['id' => 1], $article->getAttributes());
        $this->assertEquals([
            $article->getKeyName() => 1,
            'text' => 'ru text',
        ], $article->getAttributesWithTranslation('ru'));
    }
}
