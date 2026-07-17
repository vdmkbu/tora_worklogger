<?php

namespace App\Modules\Project\Models;

use App\Modules\Log\Models\Log;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';

    public const STATUS_DISABLED = 'disabled';

    public $timestamps = false;

    protected $fillable = [
        'name', 'status',
    ];

    public static function statusesList(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DISABLED => 'Disabled',
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

    public function switchStatus(): void
    {
        $this->status = $this->isActive() ? self::STATUS_DISABLED : self::STATUS_ACTIVE;
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
