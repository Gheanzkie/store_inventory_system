<?php
namespace App\Models;

use CodeIgniter\Model;

class SalesItemModel extends Model
{
    protected $table = 'sales_items';
    protected $allowedFields = ['product_id', 'quantity', 'price'];

    public function getSalesItems()
    {
        $builder = $this->db->table($this->table . ' as si');
        $builder->select('si.id, p.name, si.price, si.quantity');
        $builder->join('product p', 'p.id = si.product_id');
        return $builder->get()->getResultArray();
    }

    public function purgeSalesItems()
    {
        return $this->db->table($this->table)->truncate();
    }
}