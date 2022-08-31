<?php

namespace App\Models;

use App\Models\Contract;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'address',
        'number',
    ];

    public $translatable = ['address'];

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    public function contracts() {
        return $this->hasManyThrough(Contract::class, Apartment::class);
    }
}
