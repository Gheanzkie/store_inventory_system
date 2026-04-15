<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'total',
        'date',
        'status',
        'payment_method',
        'amount_received',
        'change_amount'
    ];
}