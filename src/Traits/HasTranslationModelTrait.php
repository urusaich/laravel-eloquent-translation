<?php

namespace Urusaich\LaravelEloquentTranslation\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Urusaich\LaravelEloquentTranslation\Interfaces\HasTranslationModel;

/**
 * @template T
 */
trait HasTranslationModelTrait
{
    /**
     * @return HasMany
     */
    public function translations(): HasMany
    {
        /**
         * @var Model|HasTranslationModel $this
         */
        return $this->hasMany(
            $this->getTranslationModel(),
            $this->getTranslationModel()->getKeyName(),
            $this->getKeyName(),
        );
    }

    /**
     * @param string $locale
     * @return T
     */
    public function translation(string $locale): Model
    {
        return Model::unguarded(function () use ($locale) {
            $attributes = [
                $this->getTranslationModel()->getKeyName() => $this->getKey(),
                'locale' => $locale,
            ];

            return ($this->getTranslationModel())
                ->newQuery()
                ->where($attributes)
                ->firstOrNew($attributes);
        });
    }

    /**
     * @param string $locale
     * @return array
     */
    public function getAttributesWithTranslation(string $locale): array
    {
        /** @var Model|HasTranslationModel $this */
        $translation = $this->translation($locale);

        if ($translation->exists) {
            $attributes = $translation->getAttributes();

            unset(
                $attributes['locale'],
                $attributes[$this->getTranslationModel()->getKeyName()]
            );

            return [
                ...$this->getAttributes(),
                ...$attributes,
            ];
        }

        return $this->getAttributes();
    }
}