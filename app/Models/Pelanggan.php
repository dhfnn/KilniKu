<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table =  'customers';
    protected $primaryKey = 'customerID';
    public $timestamps = false;

    protected $fillable = [
        'customerName',
        'address',
        'phoneNumber',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customerID');
    }
}
