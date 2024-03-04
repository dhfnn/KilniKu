<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'transactionID';
    public $timestamps = false;

    protected $fillable = [
        'transactionDate', 'customerID', 'userID', 'totalPrice', 'checkupID'
    ];

    public function customer()
    {
        return $this->belongsTo(Pelanggan::class, 'customerID');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'userID');
    }

    public function checkup()
    {
        return $this->belongsTo(Checkup::class, 'checkupID');
    }

    public function subtransactions()
    {
        return $this->hasMany(Subtransaction::class, 'transID');
    }
}
