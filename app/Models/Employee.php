<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'employees';
    protected $primaryKey = 'employeeID';
    protected $fillable = [
        'name',
        'position',
        'birthdate',
        'phoneNumber',
        'address',
        'startWork',
        'gender',
        'image'
    ];
}
