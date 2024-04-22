<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'discount_codes';

    protected $guarded = [
        'id'
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
