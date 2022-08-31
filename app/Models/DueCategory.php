<?php

namespace App\Models;

use App\Models\Due;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DueCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'order',
    ];

    protected $hidden = ['updated_at'];

    public $translatable = ['name'];

    public $timestamps = false;

    protected static function booted()
    {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('order', "ASC");
        });
    }

    public function dues() {
        return $this->hasMany(Due::class);
    }
}