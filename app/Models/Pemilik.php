<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    protected $fillable = ['no_wa', 'alamat'];

    public function User()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function Pet()
    {
        return $this->hasMany(Pet::class, 'idpet', 'idpemilik');
    }
}
