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
        return 'Updated ' . $this->value->timezone('Europe/London')->format('D M jS  H:i');
    }
}
