<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'group' => $group,
                'value' => $value,
                'type' => $type,
            ]
        );
    }
}
