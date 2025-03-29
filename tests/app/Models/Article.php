<?php

namespace Urusaich\LaravelEloquentTranslation\Tests\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Urusaich\LaravelEloquentTranslation\Interfaces\HasTranslationModel;
use Urusaich\LaravelEloquentTranslation\Traits\HasTranslationModelTrait;

/**
 * @implements HasTranslationModel<ArticleTranslation>
 *
 * @property-read int|null $id
 */
class Article extends Model implements HasTranslationModel
{
    /**
     * @uses HasTranslationModelTrait<ArticleTranslation>
     */
    use HasTranslationModelTrait;

    public $timestamps = false;

    public function getTranslationModel(): Model
    {
        return new ArticleTranslation();
    }
}