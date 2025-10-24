<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'name',
        'value',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('name', function (Builder $builder) {
            $builder->where('name', static::inferName());
        });

        static::saving(function ($setting) {
            if (! is_null($setting->name)) {
                return;
            }

            $setting->name = static::inferName();
        });
    }

    protected static function inferName(): string
    {
        return Str::of(static::class)
            ->classBasename()
            ->beforeLast('Setting')
            ->kebab()
            ->toString();
    }

    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }
}
