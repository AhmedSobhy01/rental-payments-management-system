<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends Model
{
    use HasFactory, HasTranslations;

    public $fillable = [
        'code',
        'name',
    ];

    protected $hidden = ['updated_at'];

    public $translatable = ['name'];

    public function tenants() {
        return $this->hasMany(Tenant::class);
    }
}