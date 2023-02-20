<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'adresses';
    protected $fillable = ['user_id', 'cep', 'uf', 'cidade', 'bairro', 'rua', 'numero', 'complemento'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
