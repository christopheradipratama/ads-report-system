<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReportTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_id',
        'status',
        'note',
    ];

    public function getCreatedAtAttribute()
    {
        if (!is_null($this->attributes["created_at"])) {
            return Carbon::parse($this->attributes["created_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }

    public function getUpdatedAtAttribute()
    {
        if (!is_null($this->attributes["updated_at"])) {
            return Carbon::parse($this->attributes["updated_at"])->format(
                "Y-m-d H:i:s"
            );
        }
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User", "id");
    }
    
    public function report()
    {
        return $this->belongsTo("App\Models\Report", "id");
    }
}