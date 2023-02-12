<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'FirstName',
        'LastName',
        'MobileNumber',
        'City',
        'FullName',
        'DateCreated',
        'CreatedBy',
        'UserID',
        'IsActive'
    ];
    
}
