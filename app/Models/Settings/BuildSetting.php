<?php

namespace App\Models\Settings;

class BuildSetting extends Setting
{
    public function casts(): array
    {
        return [
            'value' => 'datetime',
        ];
    }

    public function forHumans()
    {
        return 'List refreshed ' . $this->value->timezone('Europe/London')->format('M jS  H:i');
    }
}
