<?php

namespace Tests\Unit;

use App\Models\Settings\BuildSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\Fixtures\TestSetting;
use Tests\TestCase;

class BuildSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_value_is_cast_to_datetime(): void
    {
        $build = Carbon::now()->subDay();
        $setting = BuildSetting::create([
            'value' => $build,
        ]);
        $setting->refresh();

        $this->assertInstanceOf(Carbon::class, $setting->value);
        $this->assertEquals($build->timestamp, $setting->value->timestamp);
    }

    public function test_name_is_automatically_populated_from_class_name(): void
    {
        $setting = BuildSetting::create([
            'value' => Carbon::now(),
        ]);

        $this->assertEquals('build', $setting->name);
    }

    public function test_global_scope_filters_by_setting_name(): void
    {
        BuildSetting::factory()->count(2)->create(['value' => Carbon::now()]);
        TestSetting::create(['value' => 'Testing 123']);

        $this->assertDatabaseCount('settings', 3);

        $this->assertCount(2, BuildSetting::all());
        $this->assertCount(1, TestSetting::all());
    }
}
