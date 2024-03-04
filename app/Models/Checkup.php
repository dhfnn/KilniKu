<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;
    protected $primaryKey = 'checkupID';
    public $timestamps = false;

    protected $fillable = [
        'checkupName', 'price'
    ];



    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'checkupID');
    }
}
