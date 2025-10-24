<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Settings\BuildSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        new BuildSetting(['name' => 'build', 'value' => Carbon::now()->toISOString()])->save();
    }
}
