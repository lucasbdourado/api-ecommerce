<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'adresses';
    protected $fillable = ['user_id', 'postal_code', 'state', 'city', 'neighborhood', 'street', 'number', 'complement'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
