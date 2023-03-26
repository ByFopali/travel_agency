<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'place_id',
        'discount_id'
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
