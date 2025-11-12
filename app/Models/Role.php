<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    protected $fillable = ['nama_role'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(
            User::class,
            'role_user',
            'idrole',   // FK pivot ke role
            'iduser'    // FK pivot ke user
        );
    }
}
