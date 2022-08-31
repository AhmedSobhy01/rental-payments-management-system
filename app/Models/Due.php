<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\DueCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Due extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'amount',
        'paid_amount',
        'discount',
        'note',
        'due_category_id',
        'tenant_id',
    ];

    protected $hidden = ['updated_at'];

    protected $appends = ['status', 'amount_with_discount', 'amount_left'];

    protected $with = ['category'];

    public $translatable = ['note'];

    public function category()
    {
        return $this->belongsTo(DueCategory::class, 'due_category_id');
    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function scopePaid($query)
    {
        return $query->where('amount', '==', DB::raw('paid_amount + discount'));
    }

    public function scopeUnpaid($query)
    {
        return $query->where('amount', '!=', DB::raw('paid_amount + discount'));
    }

    public function getAmountWithDiscountAttribute()
    {
        return ($this->attributes['amount'] - $this->attributes['discount']) / 100;
    }

    public function getAmountLeftAttribute()
    {
        return ($this->attributes['amount'] - $this->attributes['discount'] - $this->attributes['paid_amount']) / 100;
    }

    public function getAmountAttribute($value)
    {
        return $value / 100;
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function getPaidAmountAttribute($value)
    {
        return $value / 100;
    }

    public function setPaidAmountAttribute($value)
    {
        $this->attributes['paid_amount'] = $value * 100;
    }

    public function getDiscountAttribute($value)
    {
        return $value / 100;
    }

    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = $value * 100;
    }

    public function getStatusAttribute()
    {
        return (($this->amount - $this->discount - $this->paid_amount) / 100) <= 0 ? true : false;
    }

    public function getAttachmentsAttribute()
    {
        return Storage::disk('public')->files('dues/' . $this->id);
    }
}