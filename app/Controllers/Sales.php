<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\SalesItemModel;
use App\Models\ProductModel;

class Sales extends BaseController
{
    protected $salesModel;
    protected $salesItemModel;
    protected $productModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel();
        $this->salesItemModel = new SalesItemModel();
        $this->productModel = new ProductModel();
    }

    // =============================================
    // SALES HISTORY PAGE
    // =============================================
    public function index()
    {
        $data['allSales'] = $this->salesModel
            ->orderBy('id', 'DESC')
            ->findAll();
            
        return view('sales/index', $data);
    }

    // =============================================
    // DELETE SALE
    // =============================================
    public function delete()
    {
        $id = $this->request->getPost('id');
        
        $items = $this->salesItemModel->where('sale_id', $id)->findAll();
        
        foreach ($items as $item) {
            $product = $this->productModel->find($item['product_id']);
            if ($product) {
                $this->productModel->update($item['product_id'], [
                    'stock' => $product['stock'] + $item['quantity']
                ]);
            }
        }
        
        $this->salesItemModel->where('sale_id', $id)->delete();
        $this->salesModel->delete($id);
        
        return redirect()->back()->with('msg', 'Sale deleted');
    }

    // VIEW SINGLE SALE RECEIPT
public function view($id = null)
{
    if (!$id) {
        return redirect()->back()->with('msg', 'Invalid ID');
    }

    $sale = $this->salesModel->find($id);
    
    if (!$sale) {
        return redirect()->back()->with('msg', 'Sale not found');
    }

    $items = $this->salesItemModel->getSalesItems($id);
    
    $total = 0;
    foreach ($items as $item) {
        $total += $item['subtotal'];
    }

    $data = [
        'sale' => $sale,
        'items' => $items,
        'total' => $total
    ];

    return view('sales/receipt_view', $data);
}
}