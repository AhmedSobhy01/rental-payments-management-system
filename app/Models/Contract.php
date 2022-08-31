<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'duration',
        'rent_amount',
        'apartment_id',
        'tenant_id',
    ];

    protected $hidden = ['updated_at'];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    protected $appends = ['end_date'];

    protected $with = ['apartment'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function scopeActive($query)
    {
        return $query->where(DB::raw('DATE_ADD(start_date, INTERVAL duration YEAR)'), '>' , DB::raw('CURDATE()'));
    }

    public function scopeRecentlyExpired($query)
    {
        return $query->whereBetween(DB::raw('DATE_ADD(start_date, INTERVAL duration YEAR)'), [DB::raw('CURDATE() - INTERVAL 2 MONTH'), DB::raw('CURDATE()')]);
    }

    public function getRentAmountAttribute($value)
    {
        return $value / 100;
    }

    public function setRentAmountAttribute($value)
    {
        $this->attributes['rent_amount'] = $value * 100;
    }

    public function getDurationAttribute($value)
    {
        return round($value, 1);
    }

    public function getEndDateAttribute()
    {
        return $this->start_date->addMonths($this->duration * 12);
    }

    public function getAttachmentsAttribute()
    {
        return Storage::disk('public')->files('contracts/' . $this->id);
    }
}