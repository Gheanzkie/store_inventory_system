<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesItemModel extends Model
{
    protected $table = 'sales_items';
    protected $allowedFields = [
        'sale_id',
        'product_id',
        'quantity',
        'subtotal',
        'created_at'
    ];

    public function getSalesItems($sale_id = 0)
    {
        return $this->db->table('sales_items si')
            ->select('si.id, p.name, p.price, si.quantity, si.subtotal')
            ->join('product p', 'p.id = si.product_id')
            ->where('si.sale_id', $sale_id)
            ->get()
            ->getResultArray();
    }

    public function clearCart($sale_id = 0)
    {
        return $this->where('sale_id', $sale_id)->delete();
    }

    public function getTotal($sale_id = 0)
    {
        $result = $this->db->table('sales_items')
            ->selectSum('subtotal')
            ->where('sale_id', $sale_id)
            ->get()
            ->getRow();
            
        return $result->subtotal ?? 0;
    }
}