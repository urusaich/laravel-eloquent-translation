<?php

namespace Urusaich\LaravelEloquentTranslation\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @template T of Model
 *
 * @property-read T[] $translations
 */
interface HasTranslationModel
{
    /**
     * @return Model
     */
    public function getTranslationModel(): Model;

    /**
     * @return HasMany
     */
    public function translations(): HasMany;

    /**
     * @param string $locale
     * @return T|Model
     * @noinspection PhpDocSignatureInspection
     */
    public function translation(string $locale): Model;

    /**
     * @param string $locale
     * @return array<string, mixed>
     */
    public function getAttributesWithTranslation(string $locale): array;
}