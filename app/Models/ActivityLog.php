<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    public $fillable = [
        'agent',
        'ip',
        'tenant_id',
        'user_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAgentAttribute($value)
    {
        return $value ?? '-';
    }

    public function getIpAttribute($value)
    {
        return $value ?? '-';
    }
}