<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISABLED = 'disabled';

    public $timestamps = false;

    protected $fillable = [
        'name', 'status'
    ];

    public static function statusesList(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DISABLED => 'Disabled'
        ];
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isDisabled(): bool
    {
        return $this->status === self::STATUS_DISABLED;
    }

    public function switchStatus()
    {
        $this->update(['status' => $this->isActive() ? self::STATUS_DISABLED : self::STATUS_ACTIVE]);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
