<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Building;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'floor',
        'number',
    ];

    protected $with = ['building'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function tenant()
    {
        return $this->hasOneThrough(Contract::class, Tenant::class);
    }
}