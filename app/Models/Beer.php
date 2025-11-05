<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Beer extends Model implements HasMedia
{
    /**
     * @use HasFactory<\Database\Factories\BeerFactory>
     */
    use HasFactory;
    use InteractsWithMedia;
    use Searchable;

    protected $fillable = [
        'url',
    ];

    protected function casts(): array
    {
        return [
            'abv' => 'float',
            'price' => 'integer',
            'quantity' => 'integer',
            'hops' => 'array',
            'tags' => 'array',
            'published_at' => 'datetime',
            'modified_at' => 'datetime',
        ];
    }

    public function searchableAs(): string
    {
        return 'beers-modified-desc';
    }

    public function toSearchableArray(): array
    {
        return Arr::except(
            $this->append(['price_for_humans', 'product_image'])->toArray(),
            ['id', 'created_at', 'updated_at'],
        );
    }

    public function priceForHumans(): Attribute
    {
        return Attribute::make(
            get: fn () => '£' . number_format($this->price / 100, 2),
        );
    }

    public function publishedAtForHumans(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at?->format('d M Y'),
        );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('full')
            ->background('#ffffff')
            ->width(500)
            ->height(500);
    }

    public function productImage(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::replaceFirst(Config::get('app.url'), '', $this->getFirstMediaUrl('product', 'full')),
        );
    }
}
