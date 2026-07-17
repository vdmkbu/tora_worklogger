<?php

namespace App\Modules\Log\Models;

use App\Modules\Project\Models\Project;
use App\Modules\User\Models\User;
use Database\Factories\LogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'user_id', 'text', 'link', 'time', 'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function timeList(): array
    {
        $timeList = [];

        for ($i = 0.25; $i <= 8; $i += 0.25) {
            $timeList[] = $i;
        }

        return $timeList;
    }

    protected static function newFactory(): LogFactory
    {
        return LogFactory::new();
    }
}
