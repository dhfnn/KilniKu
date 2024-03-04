<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'Users';
    protected $primary ='id';
    public $timestamps = false; 
    protected $fillable = [
        'username',
        'name',
        'password',
        'role'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'userID');
    }
}

