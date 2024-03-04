<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtransaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'subtransactionID';
    public $timestamps = false;

    protected $fillable = [
        'transID', 'productID', 'quantity', 'subTotal'
    ];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID');
    }
}
