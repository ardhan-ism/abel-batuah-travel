<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function getInt(string $key, int $default = 0): int
    {
        $val = Setting::where('key', $key)->value('value');
        if ($val === null) return $default;
        return (int) $val;
    }
}