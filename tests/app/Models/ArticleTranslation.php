<?php

namespace Urusaich\LaravelEloquentTranslation\Tests\app\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $text
 */
class ArticleTranslation extends Model
{
    protected $table = 'articles_translations';

    public $timestamps = false;
}