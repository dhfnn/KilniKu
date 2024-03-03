<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = false;
    protected $primaryKey = 'productID';
    protected $fillable = [
        'name',
        'stock',
        'description',
        'expiryDate',
        'purchasePrice',
        'sellingPrice',
        'category',
        'image',
        'supplierID',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'supplierID');
    }
}
