<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'supplier';
    protected $primaryKey = 'supplierID';
    protected $fillable = [
        'supplierName', 'phoneNumber'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'supplierID', 'supplierID');
    }

}
