<?php

namespace RyanChandler\FilamentNavigation\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $handle
 * @property array $items
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Collection $translated_items
 */
class Navigation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'items' => 'json',
    ];

    public function translatedItems(): Attribute
    {
        $locale = app()->getLocale();
        return new Attribute(
            get: fn () => collect($this->items)
                ->transform(fn ($item) => (object)[
                    'label' => $item['label'][$locale] ?? '',
                    'handle' => $item['handle'][$locale] ?? '',
                    'type' => $item['type'],
                    'data' => $item['data'] ?? null,
                ])
        );
    }

    public static function fromHandle(string $handle): ?static
    {
        return static::query()->firstWhere('handle', $handle);
    }

    public static function fromHandleOrFail(string $handle): ?static
    {
        return static::query()->where('handle', $handle)->firstOrFail();
    }
}
