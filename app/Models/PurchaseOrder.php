<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'purchase_orders';
    protected $fillable = [
        'CustomerID',
        'DateOfDelivery',
        'Status',
        'AmountDue',
        'DateCreated',
        'CreatedBy',
        'UserID',
        'IsActive'
        
       
    ];
}
