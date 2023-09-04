<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Carbon\Carbon;

class Report extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;
    
    protected $fillable = [
        'reporter_id',
        'category_id',
        'ticket_id',
        'title',
        'description',
        'status',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['ticket_id', 'title','description','status'])
                ->setDescriptionForEvent(fn(string $eventName) => "This report has been {$eventName}")
                ->useLogName('Report');
    }
    
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
    
    public function reporter()
    {
        return $this->belongsTo("App\Models\Reporter", "id");
    }
    
    public function category()
    {
        return $this->belongsTo("App\Models\Categories", "id");
    }

    public function reportTracker()
    {
        return $this->hasMany(ReportTracker::class, 'report_id');
    }
}