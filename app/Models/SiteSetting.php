<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    public static function get($key, $default = null)
    {
        if (!Schema::hasTable((new static())->getTable())) {
            return $default;
        }

        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function getTranslatabled($key, $default = null)
    {
        $locale = app()->getLocale();
        $localizedKey = $key . '_' . $locale;
        $val = static::get($localizedKey);
        if ($val !== null && $val !== '') {
            return $val;
        }
        return static::get($key, $default);
    }

    public static function set($key, $value, $type = 'string', $group = 'general')
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }

    public function getValueAttribute($value)
    {
        if ($value === null || $value === '') {
            return $value;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $value;
    }

    public function setValueAttribute($value): void
    {
        $this->attributes['value'] = is_array($value) || is_object($value)
            ? json_encode($value)
            : $value;
    }
}
