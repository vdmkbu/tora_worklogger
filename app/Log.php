<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'text', 'link', 'time', 'date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function timeList()
    {
        for ($i = 0.25; $i <= 8; $i+=0.25)
        {
            $timeList[] = $i;
        }

        return $timeList;
    }
}
