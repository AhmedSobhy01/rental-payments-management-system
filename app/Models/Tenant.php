<?php

namespace App\Models;

use App\Models\Due;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthday',
        'nationality_id',
        'national_card_no',
        'passport_no',
        'married',
    ];

    protected $hidden = ['updated_at'];

    public $translatable = ['name'];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function dues() {
        return $this->hasMany(Due::class);
    }
}