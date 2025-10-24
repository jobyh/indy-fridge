<?php

namespace Database\Factories\Settings;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settings\BuildSetting>
 */
class BuildSettingFactory extends Factory
{
    protected $model = \App\Models\Settings\BuildSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => Carbon::now(),
        ];
    }
}
