<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sku extends Model
{
    use HasFactory;
    protected $table = 'skus';
    protected $fillable = [
        'Name',
        'Code',
        'UnitPrice',
        'DateCreated',
        'CreatedBy',
        'UserID',
        'IsActive'
    ];
    
}
