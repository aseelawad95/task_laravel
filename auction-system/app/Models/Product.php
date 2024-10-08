<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image', 
        //'seller_id', 
    ];


    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }


    public function offers()
{
    return $this->hasMany(Offer::class);
}
}
