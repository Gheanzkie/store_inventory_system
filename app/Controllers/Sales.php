<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\SalesItemModel;
use App\Models\ProductModel;
use App\Models\LogModel;

class Sales extends BaseController
{
    protected $salesModel;
    protected $salesItemModel;
    protected $productModel;
    protected $logModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->salesItemModel = new SalesItemModel();
        $this->productModel = new ProductModel();
        $this->logModel = new LogModel();
    }

    public function index()
    {
        $data['allSales'] = $this->salesModel->orderBy('id', 'DESC')->findAll();
        return view('sales/index', $data);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $items = $this->salesItemModel->where('sale_id', $id)->findAll();
        foreach ($items as $item) {
            $product = $this->productModel->find($item['product_id']);
            if ($product) $this->productModel->update($item['product_id'], ['stock' => $product['stock'] + $item['quantity']]);
        }
        $this->salesItemModel->where('sale_id', $id)->delete();
        $this->salesModel->delete($id);
        
        // ✅ LOG ACTIVITY
        $this->logModel->addLog('Deleted sale #' . $id, 'DELETE');
        
        return redirect()->back()->with('msg', 'Sale deleted');
    }

    public function view($id = null)
    {
        if (!$id || !$sale = $this->salesModel->find($id)) return redirect()->back()->with('msg', 'Sale not found');
        $items = $this->salesItemModel->getSalesItems($id);
        return view('sales/receipt_view', ['sale' => $sale, 'items' => $items, 'total' => array_sum(array_column($items, 'subtotal'))]);
    }
}