<?php

namespace App\Controllers;

use App\Models\SalesItemModel;
use App\Models\ProductModel;
use App\Models\SalesModel;

class Sales_Items extends BaseController
{
    protected $salesItemModel;
    protected $productModel;
    protected $salesModel;

    public function __construct()
    {
        $this->salesItemModel = new SalesItemModel();
        $this->productModel   = new ProductModel();
        $this->salesModel     = new SalesModel();
    }

    public function index()
    {
        $sale_id = $this->request->getGet('sale_id');

        $data = [
            'products'   => $this->productModel->findAll(),
            'salesList'  => $this->salesModel->orderBy('id', 'DESC')->findAll(),
            'activeSale' => $sale_id,
            'salesItems' => $this->salesItemModel->getSalesItems($sale_id)
        ];

        return view('sales_items/index', $data);
    }

    // ADD ITEM
    public function save()
    {
        $sale_id   = $this->request->getPost('sale_id');
        $productId = $this->request->getPost('product_id');
        $quantity  = (int) $this->request->getPost('quantity');

        if (empty($sale_id)) {
            return redirect()->back()->with('msg', 'Please select a sale first');
        }

        $product = $this->productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('msg', 'Product not found');
        }

        $existing = $this->salesItemModel
            ->where('sale_id', $sale_id)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {

            $newQty = $existing['quantity'] + $quantity;

            $this->salesItemModel->update($existing['id'], [
                'quantity' => $newQty,
                'subtotal' => $product['price'] * $newQty
            ]);

        } else {

            $this->salesItemModel->insert([
                'sale_id'    => $sale_id,
                'product_id' => $productId,
                'quantity'   => $quantity,
                'subtotal'   => $product['price'] * $quantity,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->back()->with('msg', 'Item added');
    }

    // DELETE ITEM
    public function delete()
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return redirect()->back()->with('msg', 'Invalid item');
        }

        $this->salesItemModel->delete($id);

        return redirect()->back()->with('msg', 'Item removed');
    }

    // ================= AJAX: GET ITEMS PER SALE =================
    public function getSaleItems($sale_id)
    {
        if (!$sale_id) {
            return $this->response->setJSON([]);
        }

        $db = \Config\Database::connect();

        $items = $db->table('sales_items si')
            ->select('p.name, si.quantity, si.subtotal')
            ->join('product p', 'p.id = si.product_id')
            ->where('si.sale_id', $sale_id)
            ->get()
            ->getResultArray();

        return $this->response->setJSON($items);
    }
}